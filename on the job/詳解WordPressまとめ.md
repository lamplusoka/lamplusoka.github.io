# 詳解WordPress
- まえがき
    - wpの原理原則を理解することにより、素早い問題解決が可能となる。業務に大きな影響となる。
    - 理解があれば品質の高いWebサイト構築も可能と考えられる

## 1章
- HTTPリクエスト 以下三つで構成
    - リクエストライン
        - 一番上の一行
        - POST /search.html HTTP/1.1\r\n
        - 【メソッド】[空白]【URL】[空白]【HTTPのバージョン】
            - HTTPリクエストメソッド
            1. GET：ページをくれよ（HTTP1.0/1.1）
            2. POST：このデータをくれてやるよ（HTTP1.0/1.1）
            3. PUT：このデータ（ファイル）をくれてやるよ（HTTP1.0/1.1）
            4. DELETE：このデータを消しちゃって（HTTP1.0/1.1）
            5. HEAD：ヘッダ情報だけくれ（HTTP1.1）
            6. CONNECT：プロキシサーバさん、ちょっくら通しておくれ（HTTP1.1）
            7. OPTIONS：サーバさん、どんなオプションを持ってるの？（HTTP1.1）
            8. TRACE：どんな経路でそっちに届いたかそのまま返してちょ（HTTP1.1）
        - POSTメソッドの場合はボディ部にPOSTデータが格納される
    - データ編集時の流れ
        1. ブラウザからWebサーバーへ
        2. Webサーバー → wp(php)→SQL
        3. SLQ → wp：ブラウザに編集後のページ表示をリダイレクト → Webサーバー → ブラウザがリダイレクトULRをリクエスト
        4. Webサーバー → wp → SQL → wp → Webサーバー → ブラウザが編集後のページを表示

    - ヘッダ
        - リクエストラインの詳細といったようなイメージ
            - Connection: keep-alive
    - メッセージボディ
        ‐ 「補足のメモ書き情報」が書かれている場所
- index.phpはWebサイト表示の場合のフロントコントローラー
- WordPressはページコントローラ方式も使っている
    - たとえば、管理画面内の投稿の編集はwp-admin/post.phpがページコントローラになっていますが、ダッシュボードの表示はwp-admin/index.phpが、ログイン処理は、wp-login.phpがペー ジコントローラとして機能します。

## 2章
- WordPressはWebサイト表示の実行領域とそれ以外の実行領域(管理画面等)のプロセスが異なる
- 実行領域は**Webサイト表示**、**管理画面**、**その他**の3つ
    - Webサイト表示はフロントコントローラ方式
        - index.phpの実行
    - 管理画面は/wp-admin/以下のURL(PHPファイル)へのアクセス
        - すなわちページコントローラ方式
    - その他、代表的なものはログインページ(/wp-login.php)やAjaxページ（/wp-admin/admin-ajax.php）
        - すなわちページコントローラ方式
- WordPressの構成要素6つ
    - WordPressコア：本体
    - プラグイン
    - テーマ
    - データベース
    - 設定ファイル
    - 画像などのアップロードデータ
- wpのファイル、ディレクトリ構成
    - 上記6つのうちデータベース以外は通常のファイルやディレクトリ
- wpコア
    - WordPressを起動させ、実行するメイン プログラムとライブラリの集合体
    - テーマやプラグインに必要な関数やクラスなどのインターフェースを提供し制御
    - wp-content ディレクトリとwp-config.php を除くすべての領域が WordPressコア
    - WordPressコアの関数ファイルやクラスファイルなどの共通ライブラリとしてのPHPファイルはwp-includesディレクトリにまとめられている
- wp-load.php
    - どのコントローラからWordPressの実行が始まったとしても、必ずインクルードされるファイル。ブートストラップとして
    - WordPressの起動を実質的に制御しWordPressを初期化する起点
    - インクルードすることによりWordPressの初期化処理を行い、WordPressコアの持つ基本機能にアクセスできるようにしている
    - wp-load.phpを利用すると、オリジナルのページコントローラを作成して、WordPressの機能を利用することができるようになる
### ページコントローラを作成してWordPressを利用する
- WordPressをインストールしたディレクトリ直下に作成
```php
//ew.2.1.simple_controller.php
<?php 
// WordPressブートストラップのロード 
require_once( 'wp-load.php' ); 
// サイト名の表示 
bloginfo( 'name' );
```
- アクセスしてPHPを実行させると、インストール時に設定したサイト名が表示される

- さらに以下を作成
```php
<?php
//ew.2.2.hello_world.php
// テーマを利用するための定数定義
define('WP_USE_THEMES', true);

// HTTPリクエストを擬似的に再現す
$_GET['p'] = 1;
$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
$_SERVER['REQUEST_METHOD']  = 'GET';
$_SERVER['REQUEST_URI']     = '/?p=1';
$_SERVER['HTTP_HOST']       = 'example.com';

// WordPress ブートストラップのロード
require_once('wp-load.php');

// WordPress クエリのセットアップ
wp();

// テンプレートローダーのロード
require_once(ABSPATH . WPINC . '/template-loader.php');
```

- ブラウザから`http://example.com/ew.2.2.hello_world.php` にアクセスすると`http://example.com/?p=1` へアクセスした場合と同じ表示が得られる
- wp 関数は、HTTPリクエストのクエリ文字列を WordPress のクエリに変換し、それをデータベースの SQL クエリに変換して、
データベースから「Hello world!」ページに必要なデータを取得する
- ABSPATHとは
    - WordPressがインストールされているディレクトリのフルパスが代入された定数
- WPINC
    - wp-setting.phpに`define( 'WPINC', 'wp-includes' );`とあり
    - つまり、ルートパス/wp-includes/
- ここの解説いいよ
    - [http://www.warna.info/archives/279/](http://www.warna.info/archives/279/)
### ここで見えてきたファイルの順番
##### 上から
- DocumentRoot直下のindex.php
    - 'WP_USE_THEMES'定数を定義してtrue入れる
    - 同階層のwp-blog-header.phpをrequire
- wp-blog-header.php
    - wp()はwp-includs/functions.phpの1103行目`function wp( $query_vars = '' )`で定義
    - [この記事](https://nskw-style.com/2012/wordpress/how-wp-works/reading-query-php-2.html)
    - ようはこれ
    1. WordPressルートのindex.phpから、wp-blog-header.phpが呼び出される。
    2. wp-load.phpという各種初期設定や関数、クラスを読み込むためのファイルが呼び出される。この段階でWordPressの動作に必要な主なクラス、関数、プラグイン、テーマのfunctions.phpの読み込みや、DB接続が完了する。
    3. wp()関数が実行される。ここでは、WPクラスが使われていてユーザ情報、リクエストURL、引数を基にquery_var, query_stringが作られ色々統合され、それをもとに$postsの中にDBから取得してきた投稿情報が入れられる。
    4. このあと、wp-includes/template-loader.phpが読み込まれる。この段階では、ウェブサイトを訪れたユーザが誰で、何を見たいと思っているのかが分かっていて、関数も実行できる状態になっているため、必要なテンプレートファイルも判別可能な状態になっている。
    - 以下はメモ
        - wp-load.php
            - 色々やってた
            - error_reporting
                - デフォルトはphp.iniで定義
                    - error_reporting = E_ALL & ~E_NOTICE
                    - display_errors = On
                    - [https://maku77.github.io/php/settings/error-level.html](https://maku77.github.io/php/settings/error-level.html)
                    - [http://php-beginner.com/function/errorfunc/error_reporting.html](http://php-beginner.com/function/errorfunc/error_reporting.html)
                    - PHP コード内で動的にエラー出力設定を変更するには、error_reporting() 関数でエラーレベルを設定し、ini_set() 関数でエラー表示の有効無効を切り替える  
                    - `<?php error_reporting(E_ALL | E_STRICT);  ini_set('display_errors', 'On');  `
            - 関数前の@はエラー制御演算子
                - これにより関数で発生したエラーについて無視される
            - 「__()」と「_e()」について
                    - 国際化対応のためのWordPressのユーザー関数です（PHPの関数ではありません）
                    - __('英文テキスト', 'ロケール');
                    - _e('英文テキスト', 'ロケール');
                    - 第1引数に渡された英文テキストを、第2引数に指定された「ロケール」に応じて翻訳
                    - [http://ysklog.net/wordpress/1616.html](http://ysklog.net/wordpress/1616.html)
- wp-blog-header.phpの構造
    - ブートストラップのロード、wp 関数の実行、テンプレートローダーのロードの3つがWordPressのWeb サイト表示の場合の基本構造になる。それぞれ、WordPressの起動と初期化、WordPressクエリの実行、テーマの適用です。

### 管理画面
- 'wp-admin/admin.php'を読み込み
    - admin.phpがブートストラップ
    - admin.phpの中でルート直下のwp-load.phpを読み込んで色々してる
- 'wp-admin/admin-header.php'を読み込み
    - 管理画面左のメインナビゲーションメニューの生成処理を含んでいる
- コンテンツがあり
- 'wp-admin/admin-footer.php'の読み込み

### wp-config.php
- wp-config.php はデータベースの接続情報など一部の重要な基本設定項目を記述する設定ファイル
- インストール時に WordPress が自動的。書き込み権限が付与されていない場合は手動で設置が必要
- wp-config.php はブートストラップの wp-load.php から読み込まれる
    - wp-load.phpを少し解説
        - ABSPATHを定義：WordPressのインストールディレクトリ
        - エラーレベルの設定
        - wp-config.phpファイルをWordPressをインストールしたディレクトリ内で探し、存在しない場合には1つ上の階層のディレクトリを探してロードする
            - つまり一つ上の階層にwp-config.phpを置いてもよし
- wp-includes/default-constants.php でデフォルトで定義される定数は、wp-config.phpでオーバーライドして定義することが可能

```php
<?php
//default-constants.php
//(略)
if ( !defined('SHORTINIT') )
define('SHORTINIT', false);
//(略)
```
- このように、「もし定義されていなければ」で始まる定数は、すべて wp-config.php で定義が可能

#### プラグイン

- プラグインは 3 つの種類がある
    - 通常のプラグイン
        - wp-content/plugins、もしくはさらに個別のプラグイン用のサブディレクトリを作成してその中にプラグイン本体となるPHPファイルやCSS などのリソースを設置
    - 特殊なプラグイン2つ
        - マストユーズプラグイン
            - マストユーズプラグインは管理画面からの有効化を必要とせず、常に有効なプラグインとして取り扱われる特殊なプラグイン
            - wp-content/mu-pluginsディレクトリを手動で作成し、そのディレクトリ直下に直接PHPファイルを設置することでインストールする
            - なお、マストユーズプラグインは、標準プラグイン情報ヘッダを必要としない
        - ドロップイン
            - [http://sbiz.aynumosir.com/site-construction/wordpress-plugin/drop-in-error](http://sbiz.aynumosir.com/site-construction/wordpress-plugin/drop-in-error)
    - 通常のプラグインは最小限、プラグインのphpファイル冒頭に`コメントで以下を記述し、wp-content/pliginsに保存すれば認識される
```php
<?php
/**
* Plugin Name: My Small Plugin
*/
```
- プラグインのアップデート
    - アップデート対象の判定は、プラグイン名で判定されるため、自分で作成したプラグインであっても公式ディレクトリに登録されているプラグインと同じ名前の場合、誤認識してアップデート対象になる可能性があるので、プラグインを作成する場合はユニークな名前をつける必要がある
    - マストユーズプラグインやドロップインはそれ単体が自動的にアップデートされることはない

##### プラガブル関数
- プラグインによってオーバーライドすることのできる WordPress コアの関数
- すべてのプラグインのロードが完了した後に WordPress によってその関数が未定義の場合に定義される
    - つまりプラグイン内で先に定義することによって置き換えが可能
- [プラガブル関数：コーデックス](https://wpdocs.osdn.jp/%E3%83%97%E3%83%A9%E3%82%AC%E3%83%96%E3%83%AB%E9%96%A2%E6%95%B0)

### フック
- WordPressのコア、テーマ、プラグイン、PHPによる実行または解釈のさまざまな段階における基本的なイベントトリガー
- フックの種類
    - フィルター
    - アクション