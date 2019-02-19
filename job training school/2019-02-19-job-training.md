# 2019.2.19 授業内容


## MariaDB+PHPの続き

#### SQLインジェクションの続き
- SQLインジェクション対策としてsprintf()を利用する外部からの入力情報を直接文字列としてSQL文に利用し、  
悪意のある命令を作成される可能性がある。  
特にwhere句に異常な文字列を入れられると意図しない条件でレコードを取得、修正、削除される可能性がでてしまう。  
例）where 1=1 で全体対象にできる ⇒ where id=〇 or 1=1 となるような文字列を送ることで攻撃できる。  
そのためプログラム側で意図した型のデータに強制変換して命令を作るようにしておく必要がある。


```php
// delete.php


<?php
$debug = true;
require_once dirname(__FILE__).'/functions.php';
$_GET = checkInput($_GET);

$sql = '';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
  mysqli_select_db($dbobj, 'practice');
  mysqli_set_charset($dbobj, 'utf8');
  $sql = sprintf('DELETE FROM stationery WHERE id=%d',
                  mysqli_real_escape_string($dbobj, $id));
  mysqli_query($dbobj, $sql) or die(mysqli_error($dbobj));
  if(mysqli_affected_rows($dbobj)){
    // 影響を受けた行数⇒削除された行数
    // idで条件をしているので、一致するのは1件。通常は1が返ってくるはず。
    // ただし
    $message = 'ID'.h($id).'を削除しました。';
  }else{
    $message = 'ID'.h($id).'は存在しません。';
  }
}else{
  $message = '不正な処理です';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="style.css" type="text/css" rel="stylesheet">
<title>商品管理システム</title>
</head>
<body>
<?php if($debug){ ?>
  <div class="debug">
  <p>デバッグ用</p>
  <p>$sql : <?php print $sql; ?></p>
  <pre>$_GET : <?php var_dump($_GET); ?></pre>
  </div>
<?php } ?>
<div id="container">
<div id="head">
<h1>商品削除</h1>
</div>
<div id="content">
<p><?php echo $message; ?></p>
<p><a href="index.php">一覧表示に戻る</a></p>
<!--#content--></div>
<!--#container--></div>
</body>
</html>
```


午後からグループワークでWebシステム作成

[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)