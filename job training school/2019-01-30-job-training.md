# 2019.1.30 授業内容

## PHP開発環境構築
### XAMPPとは
PHPのテスト環境構築などの場合、手軽な「XAMPP」を利用することが増えている。  

- インストール時に「MySQL」とあるが、中身は「MariaDB」（旧バージョンでは「MySQL」）
	- レンタルでWebサーバーを借りるとだいたい「MySQL」だったが、買収されたため一部有料となった。
	- 「MySQL」側の無料DBの信念の元「MariaDB」が作られる。そのため「MySQL」と「MariaDB」は互換がある。
- XAMPPのバージョン = PHPのバージョン
	- 開発環境と本番環境のバージョンを合わせる。バージョンが新しいと古いものが動かないことがある


#### ブラウザ表示までの流れ
1. ブラウザをURLを入力してサーバにリクエストを送る
2. サーバ上のPHPファイルが実行されHTMLファイルを生成する
3. サーバー側で生成されたHTMLファイルがレスポンスで返され、ブラウザに表示される

#### XAMPPのセットアップ
- XAMPPをインストールしただけでは日本語をうまく扱えないので、設定ファイルを変更する。
- 日本語対応のほかにエラー表示等の設定についても変更する。

##### php.iniの編集
- 開始タグの短縮形に関する設定変更
	- short_open_tag=Off → short_open_tag=On
- 開始タグの短縮形
	- 「short_open_tag=On」にすることで下記の開始タグ短縮形を使用できる。よって以下の記述はすべて同じ。
		- <?php echo 'Hello World!!';?>
		- <? echo 'Hello World!!';?>
		- <?='Hello World!!';?>

- エラーの表示に関する設定変更
	- 開発時は詳細なエラーを表示させてデバッグの手がかりにする。
		- error_reporting=E_ALL & ~E_DEPRECATED & ~E_STRICT → error_reporting=E_ALL 
- 公開時のエラー表示
	- 公開時にエラー内容が表示されると内部のパス情報等が第三者にわかってしまうため状況に合わせて変更する。
		- 開発時：display_errors=On	
		- 公開時：display_errors=Off

- HTTPヘッダに出力するデフォルト文字コード設定変更
	- ;default_charset="UTF-8" → default_charset="UTF-8"


- マルチバイト文字に関する設定
	- マルチバイト文字で使用する言語を指定する。
	- ;mbstring.language = Japanese → mbstring.language = Japanese

- 自動文字エンコードの検出に関する設定変更
	- PHP内で使用される文字列の文字エンコードの検出順を指定する。
		- ;mbstring.detect_order = aut → mbstring.detect_order = UTF-8,SJIS,EUC-JP,JIS,ASCII

- タイムゾーンに関する設定
date.timezone=Europe/Berlin → date.timezone=Asia/Tokyo

### PHPの記述法
- PHPブロック → `<?php php記述 ?>`
- 文字列を扱う場合は「''」もしくは「""」で囲う
- 命令文の最後に必ず「;」をつける
- 「?>(終了タグ)」直前は「 ; (セミコロン)」が省略可能
- コメントの記述法
	- 単一行コメント：//
	- 複数行コメント：/* ～ */
- 命令途中の改行はOKだが、単語途中での改行はNG
- 大文字小文字が区別される
- ファイル名拡張子は「.php」

### XAMPPのドキュメントルート
- [XAMPPのインストールフォルダ]\xammp\htdocs
- http://localhost/ → [XAMPPのインストールフォルダ]\xammp\htdocs
- http://localhost/sample/01_test.php → C:\Users\ica\Desktop\xammp\htdocs\sample\01_test.php 


#### 文字列として出力
- echo命令：後に続く値を出力
- print命令：後に続く値を出力
- 文字列連結：値.値

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>出力</title>
</head>
<body>
<h1>出力</h1>
<h2>echo命令</h2>
<p>
<?php
echo 'echo命令で文字列の出力';
?>

</p>

<h2>print命令</h2>
<p>
<?php
print 'print命令で文字列の出力'
 ?>
</p>

<h2>文字列の連結</h2>
<p>
<?php
echo '文字列'.'連結';
echo '複数の文字列を'. '<br>' . '連結できます。';
 ?>
</p>
</body>
</html>
```


##### echo()とprint()の違い
1. echo()はカンマ「,」区切りで複数の文字列を指定できるのに対し、print()はできません。
- 引数の複数指定

```php
print "Hello", "World"; // この構文はエラーが出ます
echo "Hello", "World"; // こっちは正しい構文です
```
※echo()文で括弧「()」をつけた場合、カンマ「,」区切りでの複数指定はできません。  
括弧「()」で括って複数指定するとエラーが出ますので注意して下さい。  

2. print()は結果を返しますが、echo()は返しません。
- 返り値の有無

```php
$output = print "Hello World"; // こっちは出力されます
$output = echo "Hello World"; // この構文はエラーが出ます
```

### 変数
$変数名 = 初期値
`$msg = '変数の勉強'`

#### 変数の型や値をそのまま出力する（デバッグ時）
`var_dump(出力する変数);`
- データ型も一緒に出力する

```php
<?php
$string = 'おいしい水';
echo $string;
echo "<br>";
var_dump($string);

$num = 100;
echo $num;
echo "<br>";
var_dump($num);

$bool = true;
echo $bool;
// trueを文字列型に変換すると「1」になる
// falseを文字列型に変換すると「空文字」になる

echo "<br>";
var_dump($bool);

$array = array(10, 20, 30);
echo $array;
echo "<br>";
var_dump($array);
?>

// 出力結果
おいしい水
string(15) "おいしい水"
// string(文字のビット数を表す)

100
int(100)
1
bool(true)


Notice:  Array to string conversion in C:\Users\ica\Desktop\xammp\htdocs\sample\04_var_dump.php on line 26

Array
array(3) {
  [0]=>
  int(10)
  [1]=>
  int(20)
  [2]=>
  int(30)
}

```

#### PHPのデータ型
- PHPの8つのデータ型：
	- スカラー型
		- 文字列型(string)
		- 整数型(integer)
		- 浮動小数点数型(float)(double)
		- 論理型(boolean)
	- 複合型
		- 配列型(array)
		- オブジェクト型(object)
	- 特殊型
		- リソース型(resource)
		- NULL(null) ()

**echo は数値型を文字列型に変換して出力→出力が終わったら元の型に戻す**  

#### エラーの種類
PHPのエラーには、構文解析中に起こるエラーとプログラム実行中に起こるエラーがある。  
構文解析中にエラーが起こった場合、一切の処理は実行されない。

|エラー名|発生時の処理|内容|発生状況|
|-|-|-|-|
|Parase Error|プログラムは一切実行しない|syntax Errorと続く。PHP文法上正しくない記述。|構文解析時|
|Fatal Error|エラー箇所以降は実行しない|実行継続に致命的エラー。未定義の処理を呼出す等。|プログラム実行時|
|Warning|処理を継続|この箇所の実行不可を示す警告。引数の間違い等。|プログラム実行時|
|Notice|処理を継続|この箇所の実行不可を示す注意。未定義変換の呼び出し等。|プログラム実行時|

- Notice: Array to string conversion
	- 「配列が文字列に変換」されてしまうという趣旨の警告メッセージです。
	- 配列は、文字列化されると強制的にArrayという文字列に変換されてしまうため、このような警告が発生します。
	- また式の記述方法が間違っている場合にも、このような警告が発生してしまうことがあります。


#### 配列の作り方

- arrayで作成
	- $変数名 = array(値,値,・・・)
	- 一番基本的な作り方
- 配列リテラルでの作成
	- $変数名 = [値,値,・・・]
- ブラケットのでの配列作成 [] → ブラケットと呼ぶ
	- $変数名[部屋番号] = 値
	- $変数名[空] = 値

```php
<?php
$shikoku = array('高知県', '香川県', '愛媛県', '徳島県' );
echo $shikoku[0];
echo $shikoku[1];
echo $shikoku[2];
echo $shikoku[3];
echo '<pre>';
var_dump($shikoku);
echo '</pre>';


$northKanto[] = '茨城県';
$northKanto[] = '栃木県';
$northKanto[] = '群馬県';
echo $northKanto[0] . '<br>';
echo $northKanto[1] . '<br>';
echo $northKanto[2] . '<br>';
echo '<pre>';
var_dump($northKanto);
echo '</pre>';

$hundred = [100, 100.0, '100', '百'];
echo $hundred[0] . '<br>';
echo $hundred[1] . '<br>';
echo $hundred[2] . '<br>';
echo $hundred[3] . '<br>';
echo '<pre>';
var_dump($hundred);
echo '</pre>';
echo count($hundred);

?>

//出力結果

高知県香川県愛媛県徳島県
array(4) {
  [0]=>
  string(9) "高知県"
  [1]=>
  string(9) "香川県"
  [2]=>
  string(9) "愛媛県"
  [3]=>
  string(9) "徳島県"
}
茨城県
栃木県
群馬県
array(3) {
  [0]=>
  string(9) "茨城県"
  [1]=>
  string(9) "栃木県"
  [2]=>
  string(9) "群馬県"
}
100
100
100
百
array(4) {
  [0]=>
  int(100)
  [1]=>
  float(100)
  [2]=>
  string(3) "100"
  [3]=>
  string(3) "百"
}
4

```
#### echo文による文字出力

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>echo文によるタグ出力</title>
</head>
<body>
<h1>echo文によるタグ出力</h1>
<p>
<img src="img/b001.jpg" alt="DPH">
</p>
<?php

$src = 'img/b001.jpg';
$alt = 'DPH';
echo '<p>';
echo '<img src="' . $src . '" alt="' . $alt . '"';
echo '</p>';

$srcs = array('img/b001.jpg', 'img/b002.jpg', 'img/b003.jpg', 'img/b004.jpg');
$alts = array('DPH', 'ねこにゃん', 'もんちゃん', '部屋');


//配列の値を利用してimgタグを作成してみよう
echo '<h1>配列利用画像</h1>';
echo '<p>';
echo '<img src="' . $srcs[0] . '" alt="' . $alts[0] . '"';
echo '</p>';
echo '<p>';
echo '<img src="' . $srcs[1] . '" alt="' . $alts[1] . '"';
echo '</p>';

echo '<p>';
echo '<img src="' . $srcs[2] . '" alt="' . $alts[2] . '"';
echo '</p>';

echo '<p>';
echo '<img src="' . $srcs[3] . '" alt="' . $alts[3] . '"';
echo '</p>';

echo '<h1>for利用画像</h1>';
for ($i=0 ; $i < count($srcs) ; $i++ ) {
  # code...
  echo '<p>';
  echo '<img src="' . $srcs[$i] . '" alt="' . $alts[$i] . '"';
  echo '</p>';
}

?>
</body>
</html>
```

### 連想配列
- 中身が連想できる配列
	- javaScriptのオブジェクトに近い
	- キー名を指定できる
- 作り方
	- $変数名 = array( キー => 値, キー => 値, キー => 値, ・・・);
	- $変数名 = [ キー => 値, キー => 値, キー => 値, ・・・];
- 基本的にキー名は文字列がほとんど

```php
<?php
$item = array(
          'f-001' => 'りんご',
          'f-002' => 'みかん',
          'd-001' => '水',
          'd-002' => 'コーラ',
          );
echo $item['f-001'] . '<br>' ;
echo $item['f-002'] . '<br>' ;
echo $item['d-001'] . '<br>' ;
echo $item['d-002'] . '<br>' ;
echo '<pre>';
var_dump($item);
echo '</pre>';


$northKanto = [
                8 => '茨城県',
                9 => '栃木県',
                10 => '群馬県',
];
echo $northKanto[8] . '<br>' ;
echo $northKanto[9] . '<br>' ;
echo $northKanto[10] . '<br>' ;
echo '<pre>';
var_dump($item);
echo '</pre>';

?>
```

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
