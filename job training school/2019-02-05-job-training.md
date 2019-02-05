# 2019.2.5 授業内容

## PHPの続き

### 値を送信
#### GET/POST形式で値を送信1

- ctype_digit
	- 数字の判別
	- 引数に指定された文字列に数字だけが含まれているかどうかを確認する
	- **与えられた文字列のすべての文字が数字（10進数）であるかどうかを調べる。**
	- 小数点「.」は数値じゃないためfalseになる。
	- 文字があったらfalseになる。

```php
//question2.php


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>アンケートフォーム</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body>
<div id="wrapper">
<div id="header">
<h1>お客様アンケート</h1>
</div><!--#header-->
<div id="main">
<?php
$error = 0;
// 性別の入力チェック
if (isset($_POST['gender'])) {
  $gender = $_POST['gender'];
  if (ctype_digit($gender)){
    if ($gender < 1 || $gender > 2) {
      $error = 5;
    }
  }else{
    $error = 4;
  }
}else{
  $error = 1;
}

// 年齢の入力チェック
if (isset($_POST['age'])) {
  $age = $_POST['age'];
  if (ctype_digit($age)){
    if ($age < 1 || $age > 5){
      $error = 7; //年齢の値がおかしい
    }
  }else{
    $error = 6; //年齢のデータ型がおかしい
  }
}else{
  $error = 2; //年齢の値が受け取れていない
}

// OSの入力チェック
if (isset($_POST['os'])) {
  $os = $_POST['os'];
  if (is_array($os)){
    foreach ($os as $value) {
      if(ctype_digit($value)){
        if ($value < 1 || $value >3){
          $error = 10;
        }
      }else{
        $error = 9;
      }
    }
  }else{
    $error = 8;
  }
}else{
  $error = 3;
}

// 結果を表示
if($error == 0){
  echo '<dl>' . "\n";
  // 性別を表示
  echo '<dt>性別</dt>';
  if ($gender == 1){
    echo '<dd>男性</dd>' . "\n";
  }else{
    echo '<dd>女性</dd>' . "\n";
  }
  //年齢を表示
  echo '<dt>年齢</dt>';
  if($age != 5){
    echo '<dd>' . $age . '0代</dd>'."\n";
  } else {
    echo '<dd>' . $age . '0代以上</dd>'."\n";
  }
  //OSを表示
  echo '<dt>OS</dt>';
  echo '<dd>';
  foreach($os as $value){
    switch($value){
      case 1:
        echo 'Windows<br>';
        break;
      case 2:
        echo 'Mac<br>';
        break;
      case 3:
        echo 'Linux<br>';
        break;
    }
  }
  echo '</dd>'."\n";
  echo '</dl>'."\n";

   echo '<p class="msg">以上の値を受け取りました。</p>';

} else {// 入力エラーがある場合のエラー表示

  echo '<p class="msg">';
  echo '<a href="question1_finish.php">戻ってアンケートの項目すべてにお答えください。</a>';
  echo '</p>';

}
?>
</div><!--#main-->
<p class="copy">&copy; アンケートフォーム</p>
</div><!--#wrapper-->
</body>
</html>
```

### クッキー

- クッキーはサーバーから送られてきたデータをブラウザに保存する仕組み。
- ブラウザに保存されたデータは次回サーバーアクセス時に自動で送信される。
- 長い期間データを保存したいときに便利。
- どのサーバーから、どのファイルからもらったか有効期限はといった情報が入ったクッキーをクライアントブラウザに保存する

- クッキー利用時の注意事項
	- 大きなデータは扱えない
		- クッキーとして保存できるデータ量はWebブラウザ依存
		- ほとんどのブラウザが5kb前後までしか扱えない
	- 重要な情報は扱わない
		- クッキーの情報はWebブラウザから簡単に見ることが可能。またクッキーの値は常にネットワーク上を流れるため  
盗聴される危険や悪意のあるウィルスによってユーザーPCからクッキー情報が流出することも考えられる  
重要な情報は扱わない  

	- 値を書き換えることができる
		- ツール等でクッキーの情報を書き換え可能。システムの根幹に関する情報は扱わない。



#### $_COOKIE

- クライアントからもらったクッキーが$_COOKIEに入る
- $_COOKIE は PHPの定義済み変数(=スーパーグローバル変数)の1つ
- $_COOKIE は Cookie(クッキー)システムによってHTTP クッキーから渡された値の変数
- $_COOKIE は 連想配列として使用する
- $_COOKIE は、関数やメソッドの内部で使用する場合、global $_COOKIE; とする必要がない


- setcookie(第一引数, 第二引数)
	- 第一引数を名前に、第二引数を値に使用してブラウザーに送るクッキーを作成する関数
	- 作成して送る
	- クッキー作成ができたらtrueを返す
	- 失敗したらfalseを返す
	- [setcookie](http://php.net/manual/ja/function.setcookie.php)
	- 第三引数には有効期限を設定可能。数値型でタイムスタンプを設定する。
	- 以下の場合setcookie関数はエラーなる。
		- setcookie関数の前にechoなどでHTML出力が実行されている
		- 文字ゴートがBOM付きのUTF-8の場合（先頭にBOMがあるため）
		- <?phpの前に空白行がある

```php
<?php
if(!isset($_COOKIE['count'])){
// カウントというクッキーを受け取っていない場合
// 初回アクセス時
  $count = 1;
}else{
  $count = $_COOKIE['count'] +1;
}
if($count >= 10){
  $bl = setcookie('count', $count, time());
//setcookie()の第三引数にはクッキーの有効期限を設定することができる
//数値型でタイムスタンプを設定する

//time()：今現在のタイムスタンプを返す

}else{
  $bl = setcookie('count', $count);
}
var_dump($_COOKIE)
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>クッキー</title>
</head>
<body>
<h1>クッキーを使ったカウンター</h1>
<p>
<?php
echo 'アクセス回数：' . $count;
echo '<br>';
echo $bl ? 'クッキーを発行しました' : 'クッキーを発行できませんでした';
?>
</p>
<p><a href="counter.php">counter.php</a></p>
</body>
</html>
```

### セッション
- セッションはクッキーを使ってユーザーを認識し、必要なデータはサーバー側に保存して使用する。  
- データがサーバー側に保存されるため悪意のあるユーザーにデータ改ざんされる心配がない。  
- ネットワーク上にデータが流れないので、盗聴される危険もない。
- クッキーに比べて安全性が高く、データ量の制限も実質ない。
- 複数のページをまたいでデータを扱いたいときに便利。

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
