# JMeterまとめ
- ダウンロード
    - Jmaterを動かすには、本体、java、Badboy(httpsのサイトをみ見るため)のインストールが必要
    - JMeter(ダウンロードと解凍のみ)とJavaのインストールが必要
    - [Qiita記事](https://qiita.com/shotets/items/d553d7be0d407a9a9a53)
    - [JMeterダウンロード](http://jmeter.apache.org/download_jmeter.cgi)
    - [Javaダウンロード](https://www.java.com/ja/download/)
- 起動
    - 解凍されたフォルダ内binフォルダ内の jmeter.bat や jmeterw.cmd をダブルクリックするか、ApacheJMeter.jar をプログラムを指定して開く
        - プログラムの選択画面が表示された場合は指定するプログラムは java


### 基本的な使い方 
1. bin/ApacheJMeter.jarをダブルクリックしJmeterを起動
2. テスト計画を右クリック→追加→Threds(Users)→スレッドグループを選択
3. スレッドグループを設定
    - スレッド数：アクセス数
    - Ramp-Up期間：～秒間の間にアクセスさせるか
    - ループ回数：テスト計画の繰り返し回数
4. シナリオ作成
    1. スレッドグループを右クリック→追加→サンプラー→HTTPリクエストを選択
    2. HTTPリクエストの以下の項目を入力
        - 名前：アクセスするページ名等を入力
        - プロトコル：https
        - サーバー名またはIPアドレス：トップページの`https://`を除いた部分を入力
            - 例）ヤフーのサイトなら「www.yahoo.co.jp」と入力
        - 


- 簡単な使い方
    - [https://qiita.com/PlanetMeron/items/a604645d6f89b6ce3a14](https://qiita.com/PlanetMeron/items/a604645d6f89b6ce3a14)
    - 起動して設定値を決め、保存すると「xxxx.jmx」ファイルができる。
    - jmxファイルを「jmeter-n.cmd」で開けばテスト実施
- 詳細説明
    - [https://www.techscore.com/tech/Java/ApacheJakarta/JMeter/index/](https://www.techscore.com/tech/Java/ApacheJakarta/JMeter/index/)
    - [こっちのほうがいいかも](http://naoberry.com/jmeter/category/senario/page/2/)
    - [いやこれか](http://mislead.jp/601.html)
    - シナリオを記憶して作るには
        - 通常はHTTPリクエストを開くページ毎に作ればよい。下記は記憶コントローラーを使う場合
        1. JMeterのHTTPプロキシを使ってURLをキャプチャして記憶コントローラーに保存するが、まずJMeterの証明書をブラウザにインストールする必要がある
            - [http://naoberry.com/jmeter/https-senario/](http://naoberry.com/jmeter/https-senario/)
        2. 記憶コントローラーをスレッドグループに追加する
        3. テスト計画右クリック→HTTPプロキシサーバーを追加する
            - ポートを443にする
        4. ブラウザのプロキシサーバーを追加する
            - [http://mislead.jp/601.html](http://mislead.jp/601.html)
                - LANにプロキシサーバーを使用するにチェック
                - アドレス：localhost
                - ポート：443(httpsのため)
        5. HTTPサーバーをスタートしてブラウザを操作すると履歴がたまる
    - シナリオを個別に作る場合(WordPressでやったこと)
        - wpのプラグイン全部削除？一部かもしれない（新規投稿画面などで「接続が切断されました」と出るため）
        - HTTPクッキーマネージャを置く
            - Cookie Policy:rfc2109に設定する
        - HTTPリクエストは記憶コントローラのをコピーして使うのがよいかも
        - レファレンスで「結果をツリーに表示」を入れるとブラウザのような感覚で見える
    - JMeterで負荷テストを行うとき、テスト実行をGUI上から行ってはいけない
        - JMeterのGUIがボトルネックになって正しい結果が得られないことがあるからです。
        - GUIはテスト計画の作成のためだけに使い、正式な負荷テストではコマンドラインから実行するのが正しい使い方です。

- Chromeの機能拡張「SwitchySharp Options Upgrade 」を入れると、Chromeだけプロキシをかけられる

### Jmeterメモ　4/16
- AWS上でLet's EncryptでSSLやっている環境にはJMeterの証明書を信頼済みにしても、プロキシサーバーで操作を記憶できない
    - 4/17にやったこと
        1. AWS上でロードバランサーを作成し、該当インスタンスに紐づける
        2. 自身のAWSアカウントだったため、下川原さん自前のDNSにロードバランサーのホスト名を登録し「jmeter.frandleakira-tiraura.moe」としてロードバランサー→kusanagi上のnginxにアクセスできるようにした
            - CNAMEに登録した様子
            - 下川原さんに渡した情報
                - ロードバランサーのDNS名(ホスト名)
                - acmで「jmeter.frandleakira-tiraura.moe」で証明書リクエストした時に検証保留となった画面から「DNS設定をエクスポート」したcsv
                    - 下川原さん処理後すぐにAWS発行済みとなった
                - 1.で作成したロードバランサーのリスナーにHTTPS:443を追加し上記発行済みの証明書を選択
                - これでまだnginxのトップページにアクセスできるようになったのみ
        3. kusanagi setting --fqdn FQDN　でkusanagi上のホスト名の設定値を「jmeter.frandleakira-tiraura.moe」へ変更
        4. これで「https://jmeter.frandleakira-tiraura.moe」で接続できるようになった
        5. JMeterのプロキシで記録できるようになった
- JMeterでhttpsを記録できてたのにできなくなった場合は、再度JMeterを解凍してプロキシ走らせて証明書をインポート