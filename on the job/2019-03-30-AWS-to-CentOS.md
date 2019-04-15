# AWSでインスタンス作成からCentOS接続まで

1. AWSでアカウント作成
2. インスタンス作成

### インスタンスにパブリックIPを設定する
- AWSは起動する度にIPアドレスが変わる
    - 固定したIPを設定するにはEC2ダッシュボードの左側の画面でElasticIPを選択
    1. パブリックIPアドレスの割り当て→Amazonプール→割り当てボタンを押す
        - 新しいグローバルIPアドレスが割り当てられる
    2. 作成されたIPアドレスを選択してアクションボタン→アドレスの関連付け
        →ポップアップが出たら先ほど作成したインスタンスを選択→関連付けるを押す
    3. httpでアクセスできるようにするためにインスタンス選択→セキュリティグループを選択
        →セキュリティグループにインスタンスが入っているので上のメニューのアクション→インバウンドルールの編集
        →Httpを追加して保存する（デフォルトで入っている模様）
### SSHによるリモートアクセス
- Macはターミナルを使える。Windowsはツールをインストールする。
    - Teraterm [https://dev.classmethod.jp/cloud/aws/aws-beginner-ec2-ssh/](https://dev.classmethod.jp/cloud/aws/aws-beginner-ec2-ssh/)
    - Windows10 1709より「OpenSSH Client (Beta)」機能を有効にすることにより使える
        - [https://news.mynavi.jp/article/20171218-win10_openssh/](https://news.mynavi.jp/article/20171218-win10_openssh/)
        - もしくはWindows Subsystem for Linux(WSL)を使う
    1. AWSで作成しダウンロードしたキーをsshフォルダに移動する
    2. アクセス権を変更する 
        - `chmod 400 ~/.ssh/キー名.pem`
    3. sshアクセスする
        - ユーザー名はOSにより異なる
        - `$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)`
            - Amazon Linux 2 または Amazon Linux AMI の場合は、ユーザー名は ec2-user です。
            - Centos AMI の場合、ユーザー名は centos です。
            - Debian AMI の場合は、ユーザー名は admin または root です。
            - Fedora AMI の場合、ユーザー名は ec2-user または fedora です。
            - RHEL AMI の場合は、ユーザー名は ec2-user または root のどちらかです。
            - SUSE AMI の場合は、ユーザー名は ec2-user または root のどちらかです。
            - Ubuntu AMI の場合は、ユーザー名は ubuntu です。
            - それ以外の場合で、ec2-user および root が機能しない場合は、AMI プロバイダーに確認してください。
            
### SSH接続ツール Poderosa Terminalで繋ぐときは
- 「秘密鍵を使用」でAWSのキーを読み込ませる
    - パスフレーズは不要
- アカウントに「centos」を入力
- 接続先にパブリックIPを入力して接続

### KUSANAGIの設定値
+---[RSA 2048]----+  
|        ..+=*=*+B|  
|       o ..*=X + |  
|      . + +.Boo =|  
|       = . = .o.+|  
|        S + = E+ |  
|       . + + . .+|  
|        . .     +|  
|         .     . |  
|                 |  
+----[SHA256]-----+  

- WordPressのDNS名：パブリックIP(DNSを取得していない状態でDNS名を指定すると
- WordPressの設定に失敗する)[https://ygkb.jp/2321#toc21](https://ygkb.jp/2321#toc21- )
- DB名：kusanagi
- DBのアクセスユーザー名：dbuser_kusanagi
- DBユーザーのパスワード：kusanagi
- WordPressのユーザー：kusanagiwp
- パスワード：kusanagiwp1!?0905

