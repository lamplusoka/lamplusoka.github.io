# 2019.2.8 授業内容

## PHPの続き



### 正規表現のつづき

```
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>正規表現１</title>
</head>
<body>
<h1>正規表現１</h1>
<p>
<?php
$str = '123-4567';
if(preg_match('/^[0-9]{3}-[0-9]{4}$/', $str)){
	// preg_match(第一引数, 第二引数)
	// 第二引数で渡した文字列が、第一引数で指定した形に一致するか確認する
	// 戻り値は数値、一致していたら1、一致していなかったら0
	// チェック中に問題が発生したらfalseを返す
	// チェック中に問題があったのか、それともチェックした結果が一致しなかったのかを確認して分岐したい場合は
	// ==== 演算子を利用して、データ型まで確認する必要がある

  echo '郵便番号です。';
}else{
  echo '郵便番号ではありません。';
}
?>
</p>
</body>
</html>
```
- パターン
	- パターンは文字列として記述するため前後を「'(シングルクォート)」で囲む。
	- 「"(ダブルクォート)」で囲むと中の「$」が変数として展開されてしまいうまく動かないことがある。
	- パターンの最初と最後をデリミタと呼ばれる「/」で区切る。
	- ('/^[0-9]{3}-?[0-9]{4}$/')⇒「-」の後に「?」を入れると「0回か1回だけマッチ」となり  
「-」が出てくるかもしれないし出てこないかもしれないとなり、つまり「-」あってもなくてもとなる。


### 代替構文
HTMLソースコードがメインのファイル（ビューファイル）で制御構文を記述する時は代替構文を使うと  
ソースコードが見やすくなる  

#### ifの代替構文

```
<?php if(条件1):?>
----- 処理内容 -----
<?php elif(条件2):?>
----- 処理内容 -----
<?php endif;?>
```
- 代替構文を使用した時は「{」の代わりに「:」を使用し、「}(閉じ中カッコ)」の代わりに「endif;」を使用する。
- 代替構文を使用すると閉じ中カッコの対象が明確になる。
- ブロック内の記述が多くなりがちなビューファイルではブロックの終了が明確な代替構文をよく使う。
- ※「elseif:」を半角スペース入れた「else if:」と記述するとエラーになる。
- while():, endwhile, for():,endfor も利用可能。

```php

// substitute.php

<?php
$value = date("d");
echo $value;
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>代替構文１</title>
</head>
<body>
<h1>代替構文１</h1>
<h2>制御構文</h2>
<?php if($value <= 10 ){ ?>
<ul>
  <li>水</li>
  <li>お茶</li>
  <li>コーラ</li>
  <li>コーヒー</li>
  <li>オレンジジュース</li>
</ul>
<?php }else if($value == 2){ ?>
<ul>
  <li>クッキー</li>
  <li>チョコ</li>
  <li>コマシュマロ</li>
  <li>ケーキ</li>
  <li>ホットケーキ</li>
</ul>
<?php } ?>
<h2>代替構文</h2>
<?php if($value <= 20): ?>
<ul>
  <li>水</li>
  <li>お茶</li>
  <li>コーラ</li>
  <li>コーヒー</li>
  <li>オレンジジュース</li>
</ul>
<?php elseif($value == 2): ?>
<ul>
  <li>クッキー</li>
  <li>チョコ</li>
  <li>コマシュマロ</li>
  <li>ケーキ</li>
  <li>ホットケーキ</li>
</ul>
<?php endif; ?>
</body>
```

#### foreachの代替構文

```php

// substitute2.php


<?php
$error[] = '名前が入力されていません';
$error[] = '住所が入力されていません';
$error[] = 'メールアドレスが入力されていません';
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>代替構文２</title>
</head>
<body>
<h1>代替構文２</h1>
<h2>制御構文</h2>
<?php if(count($error)){ ?>
  <ul>
    <?php foreach ($error as $val) { ?>
      <li><?php echo $val; ?></li>
    <?php
// できる限りHTMLで表現できるものはPHPブロックから出してあげる
//⇒PHPのプログラマとHTMLのコーダーで別々に確認を取りながら作業を進められる

 } ?>
  </ul>
<?php } ?>

<h2>代替構文</h2>
<?php if(count($error)): ?>
  <ul>
    <?php foreach ($error as $val): ?>
      <li><?php echo $val; ?></li>
    <?php  endforeach; ?>
  </ul>
<?php endif; ?>
</body>
</html>
```
### メールフォーム
メールフォームの使い方
[メールフォーム](docs/php/sample_fin/contact/form1.php)  

[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
