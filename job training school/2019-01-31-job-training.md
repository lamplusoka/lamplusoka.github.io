# 2019.1.31 授業内容

## PHPの続き

### 連想配列の続き

- 「=>」：ダブルアロー演算子という
- 連想配列はキー要素に任意の番号を指定することも可能





```php
$northKanto = [
                8 => '茨城県',
                9 => '栃木県',
                10 => '群馬県',
];

```

#### PHPの配列の特徴
- 配列（添字配列）と連想配列はどちらも同じ配列型
- 連想配列は入力が保証される順序付きマップ
	- キーには数値と文字列を混ぜて使用できる

#### 多次元配列

```php
$imgs = array(
  array('img/b001.jpg', 'DPH'),
  array('img/b002.jpg', 'ねこにゃん'),
  array('img/b003.jpg', 'もんちゃん'),
  array('img/b004.jpg', '部屋'),
   );

echo $imgs[0][0] . '<br>';
echo $imgs[0][1] . '<br>';
echo $imgs[1][0] . '<br>';
echo $imgs[1][1] . '<br>';
echo $imgs[2][0] . '<br>';
echo $imgs[2][1] . '<br>';
echo $imgs[3][0] . '<br>';
echo $imgs[3][1] . '<br>';
```

##### 連想多次元配列も可能

```php
$imgs = array(
  'name1' => array('img/b001.jpg', 'DPH'),
  'name2' => array('img/b002.jpg', 'ねこにゃん'),
  'name3' => array('img/b003.jpg', 'もんちゃん'),
  'name4' => array('img/b004.jpg', '部屋'),
   );

echo $imgs['name1'][1];
```
### 演算子

#### 演算子の優先順位
[演算子の優先順位](http://php.net/manual/ja/language.operators.precedence.php)

- 「\* \/ \%」 が「\+ \- .」より優先


#### 算術演算子

```php
echo '答えは' . 4 + 2 . '<br>';
// '答えは4' + 2 . '<br>'
// + の左側が数値じゃない！エラーが発生する。
echo '答えは' . 4 - 2 . '<br>';
// - も上記と同様

echo '答えは' . 4 * 2 . '<br>';
echo '答えは' . 4 / 2 . '<br>';
echo '答えは' . 4 % 2 . '<br>';

//出力結果
Warning: A non-numeric value encountered in C:\Users\ica\Desktop\xammp\htdocs\sample\10_arithmetic_operator.php on line 14
2

Warning: A non-numeric value encountered in C:\Users\ica\Desktop\xammp\htdocs\sample\10_arithmetic_operator.php on line 17
-2
答えは8
答えは2
答えは0


echo '答えは' . (4 + 2) . '<br>';
//こういう書き方でできる
```

### if文（ネストも併せて）

```php
<?php
$x = 35;
if($x >= 30){
  if($x < 40){
    echo 'xは30以上40未満';
  }
}
// if-else if-elseを利用して記述しても
// ifのネスト（入れ子）を利用して記述しても同じように条件分岐が可能。
// 使い分け方として、メインで通したいルートをifの条件がtrueになるように持っていく。（できる限り）
// イレギュラーな処理をelse側に持っていく。

?>
```
### 真偽値への変換

```php
<?php
$x = 0;
var_dump($x);
if($x){
  echo 'trueと判断された';
}else{
  echo 'falseと判断された';
}

?>

// 出力結果
int(0) falseと判断された
```

以下の置き換えルールがある。
- false（偽）になる
	- 整数型（interger）の「0」
	- 浮動小数点型（float）の「0.0」
	- 空の文字列と文字列の「'0'」
	- 要素のない配列
	- NULL値

- true（真）になる
	- 上記以外の値
		- ※「-1」もtureに変換される


### 三項演算子

`条件 ? trueだった時の値（処理）：falseの時の値（処理）;`
- 三項演算子をはif-elseの代わりに使用できる
- ただし複雑な処理をまとめて書くと読みづらくなるため、乱用しないのが一般的
- 一行の出力や変数の代入時にどちらからを使うかで分岐する場合くらいに抑えるほうがよい
	- `$str = ($x == $y)? '等しい':'等しくない';

```php
<?php
$x = 10;
$y = 10;

echo '$x : ';
var_dump($x);
echo '$y : ';
var_dump($y);
echo '<br>';

echo ($x == $y)? '等しい':'等しくない';

?>

//出力結果
$x : int(10) $y : int(10) 
等しい
```

**※PHPの仕様でダブルクォート「""」で囲った中に変数があると、変数の中身（値）を展開（出力）する**

```php
<?php
$x = 10;

echo "$x : ";

//出力結果
10 :
```

#### for文を使ってタグを出力

- selectタグとは
	- [http://www.htmq.com/html5/select.shtml](http://www.htmq.com/html5/select.shtml)
	- [https://html-coding.co.jp/annex/dictionary/html/select/](https://html-coding.co.jp/annex/dictionary/html/select/)

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>for文でタグ出力</title>
</head>
<body>
<h1>for文でタグ出力</h1>
<?php
echo '日付:<select name="date">';
for ($i=1; $i <= 31; $i++) {
  echo '<option value="' . $i . '">' . $i .'</option>' . "\n";
}
echo '</select>'

?>
</body>
</html>
```

##### ソースコード上で改行
`"\n"`
- ソースコードの可読性を高めるため、ソースコード上で改行させるときは「”\n”」を使う。  
- \nをダブルクォートで囲まないと機能しないので注意。  
- ほかに「echo PHP_EOL」という改行する定数がある。(EOL = end of line)  
	- 定数は変数ではないため「＄」は不要。

#### エスケープシーケンス
改行やタブ等、文字列として直接記述できない文字を「\バックスラッシュ」使って記述する方法


#### ヒアドキュメント
- 長い文字列を変数に代入したり、出力する場合に使う。
- 「<<<」の後ろで終端IDを指定し、その**終端IDが行頭**に出てくるまでを全て文字列として扱う。
- この"ヒアドキュメント"の中では'シングルクォート'や"ダブルクォート"をエスケープする必要がない。
- **終端ID必ず行頭に来ること**
- **終端IDは字下げ（インデント）しないこと**
- ヒアドキュメントの中でエスケープシーケンスは機能する
- ヒアドキュメントの中に変数$があると、変数の値を出力する

- 終端ID
	 - 自身で決められる。よく使われるID↓
		- EOD （End Of Document）
		- EOM （End Of Message）
		- EOF （End Of File）

```php
echo <<< EOD
「<<<」の後ろで終端IDを指定し、\nその終端IDが行頭に出てくるまでを全て文字列として扱います。\n
この"ヒアドキュメント"の中では'シングルクォート'や"ダブルクォート"をエスケープする必要がありません。<br>
投稿者：$name<br>
投稿日：$today
EOD;
```



#### 現在の日時を取得する
`date(フォーマット文字列)`  

- date関数を利用すると現在の日時を取得できる。指定したフォーマットに合わせた文字列で取得される。
	- 例) date('Y-m-d) ⇒ 2017-07-01

##### 指定できるフォーマット文字（主に生年月日時分秒）

|フォーマット|説明|例|
|-|-|-|
|Y|年（西暦の4桁）|2017|
|y|年（西暦の2桁）|17|
|M|月（2桁の月）|08|
|n|月（1桁で先頭に0を付けいない）|8|
|d|日（2桁の日付）|21|
|H|時間（2桁の24時間単位）|16|
|h|時間（2桁の12時間単位）|08|
|i|分（2桁の分）|20|
|s|秒（2桁の秒）|30|
|t|指定した月の日数（28~31）|31|
|w|曜日（0：日 ～ 6：土）|2(火)|


#### foreach文
- とてもよく使う

```php
<?php
$nums = array(100, 200, 300);
$items = array(
  'アイテム1' => 'リンゴ',
  'アイテム2' => 'にんじん',
  'アイテム3' => 'プロテイン',
);
echo '<pre>';
var_dump($nums);
echo '</pre>';
foreach ($nums as $value) {
  echo $value . '<br>';
}

foreach ($items as $value) {
  echo $value . '<br>';
}

?>
```



[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
