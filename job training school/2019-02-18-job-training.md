# 2019.2.18 授業内容


## MariaDB+PHPの続き

#### 小耳情報
- 「\0」はNULLバイトの意味

```php
// insert.php

<?php
$debug   = true;
require_once dirname(__FILE__).'/functions.php';
$_POST   = checkInput($_POST);
// 入力された文字列に異常な値がないかチェック
// 修正したものを再度 $_POSTに戻す

$item    = isset($_POST['item'])    ? $_POST['item']    : NULL;
// $_POST['item']があれば(itemの項目が受け取れていれば)、その値を$itemに代入。なければNULLを代入。
$price   = isset($_POST['price'])   ? $_POST['price']   : NULL;
$stock   = isset($_POST['stock'])   ? $_POST['stock']   : NULL;
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : NULL;
$maker   = isset($_POST['maker'])   ? $_POST['maker']   : NULL;

$item    = trim($item);
// trim：文字列前後に入っている余計な空白や改行、タブ等を取り除いて、元の変数に入れ戻す。
// 何も入っていなかった場合(NULL)は、空の文字列を返す。
$price   = trim($price);
$stock   = trim($stock);
$keyword = trim($keyword);
$maker   = trim($maker);

$sql = '';
$message = '';
$btn = '';
if($item == '' OR $maker == ''){
  // $itemと$makerは必須項目のため、空の場合に再入力を促すメッセージを表示する
  $message = '必須項目を入力してください';
  $btn = '<a href="entry.php" onclick="history.back(); return false;">フォームに戻る</a>';
  // タグでentry.phpへのリンクを作成 ⇒ クリックして遷移すると、新たにentry.phpにアクセスする。
  // そのため先程入力した内容は入っていない状態になる。
  // JavaScriptが動く環境であれば履歴を一つ戻る(前のページに戻る)機能を利用することにで入力済みのentry.phpに戻してあげる
}else{
  $dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
  mysqli_select_db($dbobj, 'practice');
  mysqli_set_charset($dbobj, 'utf8');
  $item = mysqli_real_escape_string($dbobj, $item);
  // mysqli_real_escape_string()
  // 引数：
  //  第一引数：どの接続について？という情報を渡す
  //  第二引数：エスケープ処理する文字列
  // 処理：MySQLもしくはMariaDBの命令(SQL)文上で意味を持つ文字をエスケープする
  // 戻り値：エスケープ済みの文字列

  // $itemは、SQL文では項目の値としてしようしたいものなので、その中にSQL文で意味を持つ特殊文字が含まれていると、
  // 誤った命令が出来上がる可能性がある。そのため、この文字列からSQL文上で意味のある特殊文字をエスケープしておく必要がある。
  // SQLインジェクション対策

  $price = mysqli_real_escape_string($dbobj, mb_convert_kana($price, 'n'));
  $stock = mysqli_real_escape_string($dbobj, mb_convert_kana($stock, 'n'));
  // mb_convert_kana()
  // 引数：
  //  第一引数：対象とする文字列
  //  第二引数：どのように変換するかを指定（変換オプションをしていする）
  // 処理：文字列を全角⇔半角カナ「等」へ変換して返す。どう変換するかを指定する必要がある関数。
  // 戻り値：変換後の文字列を返す

  // 数字が入ってほしい項目については、SQL文上では半角数字である必要がある。(DB上では最終的に数値として扱うため)
  // なので入力されてきた文字列が全角数字だったら半角数字に変換して処理を続ける
  $keyword = mysqli_real_escape_string($dbobj, $keyword);
  $maker = mysqli_real_escape_string($dbobj, mb_convert_kana($maker, 'n'));
  $sql = sprintf('INSERT INTO stationery SET item="%s", price=%d, stock=%d, keyword="%s", maker=%d',
                 $item, $price, $stock, $keyword, $maker);
  // sprintf()
  // 引数
  //  第一引数：フォーマット文字列(穴あき状態のひな形)。%〇で指定されている部分が穴
  //  第二引数以降：フォーマット文字列の穴あき部分に入れていく文字列。
  //    第二引数から順にフォーマット文字列の先頭の穴から埋めていく
  //    %〇 ← ここで指定された型に強制的に変換される
  // 処理：フォーマット文字列に第二引数以降を穴埋めして文字列を作成する
  // 戻り値：出来上がった文字列を返す

  // 数字が入るべきところには半角数字が入るように、文字列が入るべきところには文字列が入るように強制的に整える。
  // なぜこの処理が必要か⇒外部から受取る値は基本的に信用できない。数字が欲しい項目に数字が入ってくるとは限らない。
  // 基本的には受け取った値はすべてPHPの講義でやったチェックが必要。そのうえでSQL文で問題が起きないように
  // テーブル上の各フィールドのデータ型と一致しないデータは送らないようにする

  mysqli_query($dbobj, $sql) or die(mysqli_error($dbobj));
  // 命令実行するが、SELECTと違って結果をひつようとせず、mysqli_queryの結果は変数に代入せず
  $message = '新規登録しました';
  $btn = '<a href="index.php">一覧表示に戻る</a>';
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
<?php if($debug): ?>
  <div class="debug">
  <p>デバッグ用</p>
  <p>$sql : <?php print $sql; ?></p>
  <pre>$_POST : <?php var_dump($_POST); ?></pre>
  </div>
<?php endif; ?>
<div id="container">
<div id="head">
<h1>新規登録</h1>
</div>
<div id="content">
<p><?php echo $message; ?></p>
<p><?php echo $btn; ?></p>
<!--#content--></div>
<!--#container--></div>
</body>
</html>
```

- mb_convert_kana()
	- 指定した文字列を半角 ⇔ 全角 変換します。
	- [mb_convert_kana](http://php.net/manual/ja/function.mb-convert-kana.php)
- sprintf()
	- フォーマットされた文字列を返す
		- 第一引数：フォーマット文字列(穴あき状態のひな形)
			- 「%」が穴あき部分
		- 第二引数以降：フォーマット文字列の穴あき部分に入れていく文字列
	- 処理：フォーマット文字列に第二引数以降を穴埋めして文字列を作成する
	- 戻り値：出来上がった文字列を返す
	- [sprintf](http://php.net/manual/ja/function.sprintf.php)


```php
//change.php 教科書129～133p

<?php
$debug = true;
require_once dirname(__FILE__).'/functions.php';
$_GET = checkInput($_GET);

$dbobj = mysqli_connect('localhost', 'Tanaka', 'Manager') or die(mysqli_error($dbobj));
mysqli_select_db($dbobj, 'practice');
mysqli_set_charset($dbobj, 'utf8');
$sql1 = 'SELECT * FROM trader';
$trSet = mysqli_query($dbobj, $sql1) or die(mysqli_error($dbobj));
$bl = false;
$sql2 = '';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql2 = sprintf('SELECT * FROM stationery WHERE id=%d',
            mysqli_real_escape_string($dbobj, $id)
          );
  $stSet = mysqli_query($dbobj, $sql2) or die(mysqli_error($dbobj));
  $bl = mysqli_affected_rows($dbobj);
  //上記行でSQL文の実行結果が反映（変更、追加、削除）された行数を取得して返す。
  //変更がないSELECTは取得した行数を返す。ありえない(DB上に無い)idを指定した場合は0が返ってくる。
  //問題なければ1が返ってくる。
  $stData = mysqli_fetch_assoc($stSet);
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
<?php if($debug): ?>
  <div class="debug">
  <p>デバッグ用</p>
  <p>$sql1 : <?php print $sql1; ?></p>
  <p>$sql2 : <?php print $sql2; ?></p>
  <p>$stData : <?php var_dump($stData); ?></p>
  <p>mysqli_affected_rows($dbobj) : <?php print mysqli_affected_rows($dbobj); ?></p>
  </div>
<?php endif; ?>
<div id="container">
<div id="head">
<h1>商品編集</h1>
</div>
<div id="content">
<?php if($bl): ?>
  <form action="update.php" method="post">
  <fieldset>
  <legend>商品情報を変更</legend>
  <p>ID:<?php echo h($stData['id']); ?>
  <input name="id" type="hidden" value="<?php echo h($stData['id']); ?>">
  </p>
  <dl>
  <dt><label for="item">商品名 <span>※必須</span></label></dt>
  <dd>
  <input name="item" type="text" id="item" size="20" maxlength="10"
   value="<?php echo h($stData['item']); ?>">
   <!-- input type="text" にvalue属性を持たせると、それは入力欄に最初に表示しておく文書になる。
    今選択した商品の情報をvalue属性に入れることで修正前の商品情報が入った入力欄を用意できる。-->
  </dd>
  <dt><label for="price">価格</label></dt>
  <dd>
  <input name="price" type="text" id="price" size="10" maxlength="10"
   value="<?php echo h($stData['price']); ?>">円
  </dd>
  <dt><label for="stock">在庫</label></dt>
  <dd>
  <input name="stock" type="text" id="stock" size="10" maxlength="10"
   value="<?php echo h($stData['stock']); ?>">
  </dd>
  <dt><label for="keyword">キーワード</label></dt>
  <dd>
  <input name="keyword" type="text" id="keyword" size="50" maxlength="255"
   value="<?php echo h($stData['keyword']); ?>">
  </dd>
  </dl>
  </fieldset>
  <fieldset>
  <legend>納入先の情報</legend>
  <dl>
  <dt>メーカー <span>※必須</span></dt>
  <dd>
  <?php
  while($trData = mysqli_fetch_assoc($trSet)) :
    // $trSetに行がある(メーカーが存在する)間繰り返す。メーカーのidとメーカー名を利用してラジオボタンを作成する
    $ck = '';
    if($trData['m_id'] == $stData['maker']){
      $ck = ' checked="checked"';
      // inputタグ(type="radio")のタグ内前の属性の値との間に必ず半角スペース「 」を入れてから「checked="checked」と記入しよう。
    }?>
    <label>
    <input name="maker" type="radio" value="<?php echo h($trData['m_id']); ?>"
    <?php echo $ck; ?>>
    <?php echo h($trData['company']); ?>
    </label>
  <?php endwhile ?>
  </dd>
  </dl>
  </fieldset>
  <div class="submit_btn"><input type="submit" value="変更"></div>
  </form>
  <p><a href="index.php" onclick="return confirm('一覧に戻りますか？')">一覧に戻る</a></p>
<?php else: ?>
  <p>不正な処理です</p>
  <p><a href="index.php">一覧に戻る</a></p>
<?php endif; ?>
<!--#content--></div>
<!--#container--></div>
</body>
</html>
```

##### SQLインジェクションとは
[https://qiita.com/ccccan/items/8712771799cf4bb7c868](https://qiita.com/ccccan/items/8712771799cf4bb7c868)





[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)