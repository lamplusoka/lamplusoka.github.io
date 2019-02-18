# 2019.2.15 授業内容


### 耳寄り情報
- 欧米ではやはり簡単なPythonが主流になってきている。
- 日本ではJavaで無数のシステムが構築されており、新規構築などは減ってきている。
- 日本ではJavaのメンテナンス・改良がメインとなっており、それがPythonの普及を遅らせている。
- またPythonの公式ドキュメントが英語のみのため、それも普及しない要因の一つとなっている。
- Pythonは独学で学べる。[PyQ](https://pyq.jp/)
	- pythonのWeb関連と関係のあるJavaScriptのライブラリ「vuejs」を勉強しておくとPythonのWebシステムも理解しやすい


## MariaDB+PHP
- PHPとMariaDBを連携させてWebシステムを作成する。
	- データベース領域とテーブルの作成
		- データベース名：practice
		- テーブル名：stationary, trader
	- ユーザーを作成
		- Tanaka/Manager を作成
		- GRANT all on practice.* to Tanaka@localhost identified by ‘Manager’;



### レコードを取得する
**最近のPHPでデータベース操作は「PDO」とう関数でDBに接続するがオブジェクト指向の説明が必要になるため今回は手続き型で接続**

```php
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>レコードを取得する</title>
</head>
<body>
<div>
<?php
$dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
//処理概要：DBサーバに接続して、接続情報を管理しておく
  //もし接続に失敗したらエラー内容を表示してこの後のすべての処理をキャンセルしてプログラムを終了
  //今回のこの記述方法だと、接続に失敗すると変数$dbobjはNULLとなりfalseとる⇒
  //⇒orより右が実行さるが$dbobjはNULLのためエラーメッセージは何も表示されない

// mysqli_connect():MySQLサーバーへ接続する関数(手続き型)
    //mysqli_connect()はmysqli::__constructという関数のエイリアスとなり、mysqli::__constructはオブジェクト指向型となる
    //そのため変数 $dbobj には接続できたよ、できるよといった情報（許可書）が入る。インスタンスとなる。
// 引数：文字列型
  // 第一引数：接続するDBサーバーのホスト名またはIPアドレス
  // 第二引数：DBサーバーに接続する際のユーザー名
  // 第三引数：パスワード
// 処理：MySQL(MariaDB)への接続をする
// 戻り値：DBサーバーへの接続情報を持つオブジェクト
// or以降：$dbobjの中身がnullか0などfalseなら実行される
  // orを指定することにより、演算子の優先順位から左側の実行結果をまず変数$dbobjに代入
  // orと同じ意味の「||」使うと代入前に右側が実行されてしまう動きとなる。
// die()：exit()と同じ
// MySQL_error()：直近のエラーの内容を文字列で返す
// 引数：DBサーバーへの接続情報を持つオブジェクト⇒この書き方だと変数$dbobjはNULLで何もエラーメッセージは表示されない

mysqli_select_db($dbobj, 'practice');
// mysqli_select_db()
// 引数：第一引数：DBサーバーへの接続情報（オブジェクト）  第二引数：使用するDB領域
// 処理：これから使うDB領域を選択する（コマンド上で「USE DB領域名」したのと同義）
// 戻り値：選択に成功した場合に TRUE を、失敗した場合に FALSE を返します。

mysqli_set_charset($dbobj, 'utf8');
//mysqli_set_charset()
//引数：
  //第一引数：DBサーバーへの接続情報（オブジェクト）
  //第二引数：指定する文字コード（PHP側から送る場合の文字コード）
//処理：クライアント側の文字コードを指定する。
//MariaDBのiniファイルで「character-set-server=utf8」で設定しており、DB側はUTF-8で入力がくると思っている
//そのため送り側のPHPも合わせないと文字化けする。基本UTF-8でコーディングするから問題はないと思われるが指定したほうがよい。

$resultSet = mysqli_query($dbobj, 'SELECT * FROM stationery') or die(mysqli_error($dbobj));
//mysqli_query()
//引数：
  //第一引数：DBサーバーへの接続情報（オブジェクト）
  //第二引数：実行させるクエリ文字列
//処理：データベース上でクエリを実行する
//戻り値：失敗したらfalse
//      成功した場合
//        SELECT等のデータ取得系の場合は取得したデータの入ったオブジェクトを返す
//      それ以外（追加、修正、削除）の場合はtrueを返す

$data = mysqli_fetch_assoc($resultSet);
// mysqli_fetch_assoc()
//現在いる行
// 引数： mysqli_queryで取得したデータ
// 処理：結果のデータから、今カーソル（初回は1行目にポインタがある）がある行の情報を連想配列で取得。
  // カラム名を部屋の名前として、各カラム内の値を部屋の中に入れる値として作成する
  // 1行分のデータを処理した後、カーソルを一行進める
// 戻り値：出来上がった連想配列を変えす

echo $data['item'];
// 今管理している連想配列の中のitemという部屋の値を出力 ⇒ 万年筆
?>
</div>
</body>
</html>

```


### PHP補足
- PHPにはもともとオブジェクトがなかった。現在は拡張機能でオブジェクトが使用できる。
- mysqli::queryは「mysqli」オブジェクト内の「query」というメソッドを呼び出していることとなる。
- mysqli_queryは元々オブジェクトという概念がなかったので、関数呼び出しと同じ書き方ができるようにした。  
mysqli::queryのエイリアスとなる。
- **「mysql」というオブジェクトがあるが古いため使用しないこと**


#### デバッグ用の表示領域
ロジック内の変数の値を把握するとエラーを見つけやすくなる。デバッグ用の領域を作成し、制作時に表示させる。

```php
//index.php


<?php
$debug = true;
// $debug = false
// 開発時用のデバック領域を画面内に表示するかを決めるための変数
// falseを代入すると下のphpブロックの処理により非表示になる
//<?php if($debug): ?>
//  <div class="debug">
//  <p>デバッグ用</p>
//  <p>$sql : <?php print $sql; ?></p>
//  </div>

require_once dirname(__FILE__).'/functions.php';
$dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
mysqli_select_db($dbobj, 'practice');
mysqli_set_charset($dbobj, 'utf8');
$sql = 'SELECT * FROM stationery';
$resultSet = mysqli_query($dbobj, $sql) or die(mysqli_error($dbobj));
$bl = mysqli_affected_rows($dbobj);
// mysqli_affected_rows
// 引数：直前のMySQL(MariaDB)への操作で影響を受けた行数を取得
// 戻り値：行数を数値で返す 
	// 直近の INSERT、 UPDATE、REPLACE あるいは DELETE クエリにより変更された行の数を返します。
	// SELECT 文の場合は、mysqli_affected_rows() は mysqli_num_rows() と同じように動作します。
		// mysqli_num_rows()：取得した結果の行数を取得する

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" type="text/css" rel="stylesheet">
<title>商品管理システム</title>
</head>
<body>
<?php if($debug): ?>
  <div class="debug">
  <p>デバッグ用</p>
  <p>$sql : <?php print $sql; ?></p>
  </div>
<?php endif; ?>

<div id="container">
<div id="head">
<h1>商品一覧</h1>
</div>
<div id="content">
<?php if($bl): ?>
//blには0か1以上の整数が入る
//0じゃない場合は結果が取れているはずなので結果を表示

  <table>
  <tr>
  <th>ID</th>
  <th>商品名</th>
  <th>価格</th>
  <th>在庫</th>
  <th>キーワード</th>
  <th>メーカー</th>
  <th>編集</th>
  <th>削除</th>
  </tr>
  <?php while($data = mysqli_fetch_assoc($resultSet)) : ?>
    <tr>
    <td><?php echo h($data['id']); ?></td>
<?php
//商品追加や修正を行うフォームを用意するので、商品情報はユーザーが入力した値が表示される可能性がある
//外部から入ってきた?倍を表示に使用する場合は、表示直前にサニタイジング(htmlspecialcharars())をしておく必要がある

?>

    <td><?php echo h($data['item']); ?></td>
    <td><?php echo h($data['price']); ?></td>
    <td><?php echo h($data['stock']); ?></td>
    <td><?php echo h($data['keyword']); ?></td>
    <td><?php echo h($data['maker']); ?></td>
    <td>編集</td>
    <td>削除</td>
    </tr>
  <?php endwhile; ?>
  </table>
<?php else: ?>
  <p>商品がありません</p>
<?php endif; ?>
<p class="btn"><a href="entry.php">新規登録</a></p>
<!--#content--></div>
<!--#container--></div>
</body>
</html>
```


### レコードの登録

- データベースの接続部分はレコードの一覧表示と同じ。実行するSQL文がSELECT⇒INSERTに変えている。
- 今回はSQL文を実行した結果をPHP内で利用しないため、変数に管理する必要がない。

```php
//insert_test.php

<?php
$dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
mysqli_select_db($dbobj, 'practice');
mysqli_set_charset($dbobj, 'utf8');
mysqli_query($dbobj, 'INSERT INTO stationery SET item="分度器", price=240, stock=6, keyword="事務", maker=2') or die(mysqli_error($dbobj));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>レコードを登録する</title>
</head>
<body>
<div>
新しい商品を追加しました
</div>
</body>
</html>
```

### 新規商品入力フォームを作成

```php
// entry.php

<?php
$debug = true;
require_once dirname(__FILE__).'/functions.php';
$dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
mysqli_select_db($dbobj, 'practice');
mysqli_set_charset($dbobj, 'utf8');
$sql = 'SELECT * FROM trader';
// メーカー情報を取得

$trSet = mysqli_query($dbobj, $sql) or die(mysqli_error($dbobj));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" type="text/css" rel="stylesheet">
<title>商品管理システム</title>
</head>
<body>
<?php if($debug): ?>
  <div class="debug">
  <p>デバッグ用</p>
  <p>$sql : <?php print $sql; ?></p>
  </div>
<?php endif; ?>
<div id="container">
<div id="head">
<h1>新規登録</h1>
</div>
<div id="content">
<form action="insert.php" method="post">
<fieldset>
<legend>新しい商品の情報</legend>
<dl>
<dt><label for="item">商品名 <span>※必須</span></label></dt>
<dd><input name="item" type="text" id="item" size="20" maxlength="10"></dd>
<dt><label for="price">価格</label></dt>
<dd><input name="price" type="text" id="price" size="10" maxlength="10">円</dd>
<dt><label for="stock">在庫</label></dt>
<dd><input name="stock" type="text" id="stock" size="10" maxlength="10"></dd>
<dt><label for="keyword">キーワード</label></dt>
<dd><input name="keyword" type="text" id="keyword" size="50" maxlength="255"></dd>
</dl>
</fieldset>
<fieldset>
<legend>メーカーの情報</legend>
<dl>
<dt>メーカー <span>※必須</span></dt>
<dd>
<?php while($trData = mysqli_fetch_assoc($trSet)) :
// $trsetに行がある（メーカが存在する）間繰り返す
// メーカーのidとメーカー名を利用してラジオボタンを作成する
 ?>
  <label>
  <input name="maker" type="radio" value="<?php echo h($trData['m_id']); ?>">
  <?php echo h($trData['company']); ?>
  </label>
<?php endwhile; ?>
</dd>
</dl>
</fieldset>
<div class="submit_btn"><input type="submit" value="登録"></div>
</form>
<p><a href="index.php" onclick="return confirm('一覧に戻りますか？')">一覧に戻る</a></p>
<!-- aタグのonclick属性にJavaScriptのコードを書く
return confirm('文書')
confirm()⇒OKをクリックするとtrue
          キャンセルをクリックするとfalse
          onclick属性の中が"return false"になった場合はaタグの標準挙動(リンク先に遷移)をキャンセルする
          つまり、このページに留まる
 -->
<!--#content--></div>
<!--#container--></div>
</body>
</html>
```



[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
