# 2019.2.6 授業内容

## PHPの続き

### セッションの続き
- セッションはクッキーを使ってユーザーを認識し、必要なデータはサーバー側に保存して使用する。  
- データがサーバー側に保存されるため悪意のあるユーザーにデータ改ざんされる心配がない。  
- ネットワーク上にデータが流れないので、盗聴される危険もない。
- クッキーに比べて安全性が高く、データ量の制限も実質ない。
- 複数のページをまたいでデータを扱いたいときに便利。


```php
//counter.php

<?php
$bl = session_start();
// session_start()
// セッション（サーバー内にデータを保存できる場所に）にこのPHPから接続できるようにする処理
// ⇒セッションを開始する、という
// 成功したらtrue、失敗したらfalseを返す
// ブラウザからのリクエストにセッションの鍵がのっている場合、以前その鍵をつけていたセッションに接続する
// セッションを再開する


if (!isset($_SESSION['count'])) {
// $_SESSION['count']が存在しない場合

  $_SESSION['count'] = 1;
	// $_SESSION内に['count']という部屋を作って、その中に 1 を入れる

}else{
  $_SESSION['count']++;
}
if ($_SESSION['count'] >= 10) {
  $_SESSION = array();
	// $_SESSIONに空の配列を代入する⇒現在保持している情報(連想配列)のアドレスを削除する
	// プログラム上、どこからもアクセスできなくなった配列は自動的に削除される(PHPの仕様)
	// ログアウトする時には以下3行はおまじないのようによく使う
	// $_SESSION = array();
	// setcookie(session_name(), '', time());
	// session_destroy();

  setcookie(session_name(), '', time());
	// session_name()：セッションの鍵を送る際につけた名前を取得する関数
	// xamppでの初期設定は PHPSESSID という名前
	
	// PHPSESSIDという名前、中身が空っぽ、有効期限が今 のクッキーを作成する

  session_destroy();
	// session_destroy():セッションが持っている情報を全て破棄する
	// 上記で$_SESSIONに代入した空の配列も削除する
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>セッションを使ったカウンター</title>
</head>
<body>
<?php
echo 'アクセス回数：' . $_SESSION['count'];
echo '<br />';
echo $bl ? 'セッションを開始しました' : 'セッションを開始できませんでした';
?>
<p><a href="counter.php">counter.php</a></p>
</body>
</html>
```

`if(count($_SESSION)){`
- 条件の結果が真偽値(true/false)ではない場合は、自動的に真偽値に置き換えられる。置き換えのルールは以下。
	- false(偽)に変換
		- 整数型(integer)の「0」
		- 浮動小数点型(float)の「0.0」
		- 空の文字列と文字列の「'0'」
		- 要素のない配列
		- NULL値
	- true(真)に変換
		- 上記以外の値  
※「-1」もtrueに変換される


セッション関連の解説コメント入りphpファイル  
[セッション](docs/session/top.php)    


### ファイルを読み込む
Webページｈヘッダやフッタ、ナビゲーションなど共通して使用する部分があり。  
PHPを使用すると共通部分をパーツ化して別ファイルにし、それら各ページで読み込み可能。  

- require 'パス/ファイル名'
	- ファイルを読み込む
	- ファイル名拡張子がphpでないと動作しないよ

#### デザインとプログラムの分離
- PHPはHTML内にプログラムを書けるため手軽に利用できる判明、ソースコード内が複雑になりがち
- ファイルの読み込みを使用することで、デザインとプログラムを分離することができる
- デザインとプログラムを切り離すことでソースコードの見通しがよくなる
- デザイン部分とプログラム部分を別の人が担当して作成するような制作手法をとることも可能


```php
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>埋め込み</title>
<?php
require 'css.html';
// ファイル読み込みでよく使うもの
// requier_once
// include

// recuireとincludeの違い
// 読み込み失敗した際のエラーのレベルが違う
// recuireは Fatal error
// reguireは失敗したらその場でPHPの処理が停止しそれいこうの処理を行わない
// その後の処理に影響
// 失敗したらいけないものの読み込みにはrecuireを使用する

// includeは warning
// エラーは出るけど処理は続行する。
// 読み込みに失敗しても処理上問題がないパーツを読み込む際に使用する。
// 主にHTMLの表示部分のパーツ

// _onceがつくものとつかないものの違い
// _onceがつくものは同じファイルの読み込みは最初の1回だけしか実行しない。

// _onceがつかないもの
// 同じファイルを複数回呼んでも問題なし



?>
</head>
<body>
<?php
require 'header.html';
require 'nav.html';
require 'main1.html';
require 'footer.html';
?>
</body>
</html>
```







[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
