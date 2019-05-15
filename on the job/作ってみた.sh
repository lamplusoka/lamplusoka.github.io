#!/bin/sh

KUSANAGIPASS=kusanagi
DBROOTPASS=kusanagi
IPADDRESS0=192.168.33.14
IPADDRESS1=192.168.33.12
IPADDRESS2=192.168.33.13
KUSANAGIPROFILE=galeratest
KUSANAGIFQDN=galera

#kusanagi init
kusanagi init --tz tokyo --lang ja --keyboard ja --passwd $KUSANAGIPASS --nophrase --dbsystem mariadb --dbrootpass $DBROOTPASS --nginx --php7 --ruby24

##git管理する
cd /etc/
git init
sudo git add -A
sudo git config --global user.name 'psuser'
sudo git config --global user.email 'support@prime-strategy.co.jp'
sudo git commit -m 'first commit'

##swap設定
cd /
mkdir swap
dd if=/dev/zero of=/swap/swap0 bs=512M count=1
chmod 600 /swap/swap0
mkswap /swap/swap0 1
swapon /swap/swap0
free -m

##swapの永続化
echo '/swap/swap0     swap    swap    defaults        0 0' >> /etc/fstab

##zabbixの仕込み
sed -i "s/^Server=127.0.0.1/Server=52.196.34.217/g" /etc/zabbix/zabbix_agentd.conf
sed -i "s/^ServerActive=127.0.0.1/ServerActive=52.196.34.217/g" /etc/zabbix/zabbix_agentd.conf
sed -i "s/^Hostname=Zabbix server/# Hostname=Zabbix server/g" /etc/zabbix/zabbix_agentd.conf
sed -i "s/^# HostnameItem=system.hostname/HostnameItem=system.hostname/g" /etc/zabbix/zabbix_agentd.conf

##zabbix起動
systemctl status zabbix-agent
systemctl enable zabbix-agent
systemctl start zabbix-agent
systemctl status zabbix-agent

##sshpassのインストール
yum -y install sshpass

#秘密鍵、公開鍵の作成、他の2台のauthorized_keysに公開鍵追加
ssh-keygen -t rsa -b 4096 -f /root/.ssh/id_rsa -N ""
sshpass -p "vagrant" ssh-copy-id root@$IPADDRESS1 -o "StrictHostKeyChecking no" 
sshpass -p "vagrant" ssh-copy-id root@$IPADDRESS2 -o "StrictHostKeyChecking no" 

chmod 700  /root/.ssh/
chmod 400  /root/.ssh/id_rsa

sed -i "s/^#PermitRootLogin yes/PermitRootLogin yes/g" /etc/ssh/sshd_config
sed -i "s/^PermitRootLogin no/PermitRootLogin yes/g" /etc/ssh/sshd_config
sed -i "s/^#RSAAuthentication yes/RSAAuthentication yes/g" /etc/ssh/sshd_config
sed -i "s/^#PubkeyAuthentication yes/PubkeyAuthentication yes/g" /etc/ssh/sshd_config
sed -i "s/^#PermitEmptyPasswords no/PermitEmptyPasswords no/g" /etc/ssh/sshd_config
systemctl restart sshd


yum -y install expect

##kusanagiプロビジョン
expect -c "
spawn kusanagi provision ${KUSANAGUPROFILE}
expect \"Which do you choose?\"
send -- \"2\"
expect \"Enter hostname(fqdn) for your website. ex) kusanagi.tokyo\"
send -- \"${KUSANAGIFQDN}\"
expect \"Re-type hostname(fqdn) for your website.\"
send -- \"${KUSANAGIFQDN}\"

"


#lsyncdの設定
cat <<EOL >> /etc/lsyncd.conf 
--General Settings
settings {
    logfile = "/var/log/lsyncd/lsyncd.log",
    statusFile = "/var/log/lsyncd/lsyncd.stat",
    maxProcesses = 2,
    statusInterval = 1,
    insist = 1,
}
--Settings for Web1
sync {
    default.rsync,
    source = "/home/kusanagi/${KUSANAGUPROFILE}/DocumentRoot/",
    target = "${IPADDRESS1}:/home/kusanagi/${KUSANAGUPROFILE}/DocumentRoot/",
    delete = "running",
    init = false,
    exclude = {"*.swp","/log/"},
    rsync = {
        archive = true,
        compress = false,
    }
}
--Settings for Web2
sync {
    default.rsync,
    source = "/home/kusanagi/${KUSANAGUPROFILE}/DocumentRoot/",
    target = "${IPADDRESS1}:/home/kusanagi/${KUSANAGUPROFILE}/DocumentRoot/",
    delete = "running",
    init = false,
    exclude = {"*.swp","/log/"},
    rsync = {
        archive = true,
        compress = false,
    }
}
EOL

#lsyncサービス再起動
systemctl start lsyncd
systemctl enable lsyncd