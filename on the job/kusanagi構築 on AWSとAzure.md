# KUSANAGU構築 on AWS
1. VPCの作成
    - Name tag : わかりやすく
        - 例）prod-renewal-madoka
    - IPv4 CIDR blok : 必要な数だけ
        - 例) 10.0.0.0/24 → 10.0.0.1 ~ 255 まで使えるVPCとなる
    - IPv6 CIDR blok : No
    - Tenancy : Default
        - tenancyとは、このVPCがハードウェアを専有するかどうか。コンプライアンス的に、専有する必要があるなら「Dedicated」を選択すると専有となるが、その分料金も上がるので注意。 
2. サブネットの作成
    - 名前タグ : わかりやすく
    - VPC : 手順1.のVPCを選択
    - アベイラビリティーゾーン : リージョン内のAZを一つ選択。冗長化する際(2つ目以降のサブネット作成時)は別のAZを選択する
        - 名前例) prod-renweal-madoka-subc
    - IPv4 CIDRブロック： 割り当てる範囲のCIDRを入れる
        - 例)10.0.0.0/28 ホストのレンジ：10.10.10.1 ～ 10.10.10.14
        - こんなサイトで確認できるよ [https://yamagata.int21h.jp/tool/cidrcalc/?](https://yamagata.int21h.jp/tool/cidrcalc/?)
3. ルートテーブルの作成
    - 手順1.のVPCを選択して、名前を付けて作成
        - 名前例) prod-renweal-madoka-rt
4. インターネットゲートウェイの作成
    - 名前を付けて作成するだけ
        - 名前例) prod-renweal-madoka-ethgw
5. ルートテーブルのRoutesタブに追加
    - Destination : 0.0.0.0/24
    - Target : 手順4.で作成したIGWを選択し作成
6. インスタンスの作成
    - 今回はt3.medium
    - マグネテイックドライブ30GB
    - 作成したサブネットを関連付ける
7. ElasticIPを選択しインスタンスに関連付ける
8. インスタンスを紐づけたサブネットのルートテーブルに
    - 送信先 : 0.0.0.0/0
    - ターゲット : 4.で作成したIGWを関連づける
9. KUSANAGIインスタンス作成時に作成されたセキュリティグループにSSH22接続許可する以下ルールを追加
    - なければSSHとHTTPを追加
    - 113.43.147.210/32  Primeの有線の固定IP
    - 202.181.103.224/32  踏み台 ※社外からSSH接続する時などに使う
    - 59.106.73.0/24  同じく踏み台
    - zabbix用のIPとポートも追加 : 52.196.34.217/32:10050
10. SSHでキーとcentosで接続する
    

## Azure
1. Chromeのシークレットモードで[Azure portal](https://azure.microsoft.com/ja-jp/features/azure-portal/)に接続
2. サブスクリプションをユーザー名でソートして選択、なければ作成？
3. バーチャルマシン→プラスの追加→AzureMarketplaceからVMを作成する→kusanagiを検索して選択
    - リソースグループを新規作成。このリソースグループにVMやネットワークやストレージなどが入る
    - 名前例）prod-renewal-carfrontier-resources
    - 仮想マシン名 : prod-renewal-carfrontier
    - 地域 : 東日本
    - 可用性: 不要
    - puttyを起動
        - Generate
        - 起動中にマウスを回すと乱数作成する
        - 作られた上のボックス内[public key for・・・]の中身をコピーする→Azure管理画面のSSH公開キーに張り付ける
        - ユーザー名をpsuserにする
        - Puttyに戻りSave Public keyで公開鍵を保存
        - Key Comment : psuser にしSave Private keyで鍵を保存。SSH接続に使う
    - ディスク
        - Standard HDDを選択
    - ネットワーク
        - 仮想ネットワークを新規作成
            - prod-renewal-carfrontier-resources-vnet/default(サブネット)
        - パブリックIPも新規作成
        - ネットワークセキュリティーグループを新規作成
        - 高速ネットワーク：オフ
        - 負荷分散：いいえ
4. puttyで作成した鍵とpsuserで接続


