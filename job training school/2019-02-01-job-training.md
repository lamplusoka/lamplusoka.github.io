# 2019.2.1 授業内容

## PHPの続き

#### foreach文の続き

```php
foreach ($配列 as $value){
  処理
  …
}
```

- とてもよく使う
- 変数$valueは任意で決めてよい

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
// foreach(対象とする配列 as 変数（変数名は任意、自分で決めてよい）)
// 繰り返し処理が一周する間は対象配列の今見ている部屋の値を変数に入れて利用できる。

  echo $value . '<br>';
}

foreach ($items as $value) {
  echo $value . '<br>';
}





// 連想配列のキー要素出力する場合

foreach ($items as $key => $value) {
// $keyにキー要素が入り、$valueに該当キーの値が入る

  echo $key . 'の値は'. $value . 'です。<br>';
}


```

#### for each文を使ってタグ出力

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>foreach文でタグ出力</title>
</head>
<body>
<h1>foreach文でタグ出力</h1>
<?php
$items = array(
          'f-001' => 'リンゴ',
          'f-002' => 'みかん',
          'd-001' => '水',
          'd-002' => 'コーラ',
);

echo '<pre>';
var_dump($items);
echo '</pre>';

foreach ($items as $key => $value) {
  echo '<label><input type="checkbox" value="' . $key . '">' . $value . '</label><br>' . "\n";

}


?>
</body>
</html>
```

##### foreach文で他のタグの出力零

```php
$images = [
    'b001' => 'DPH',
    'b002' => 'ねこにゃん',
    'b003' => 'もんちゃん',
    'b004' => '部屋',
    ];

foreach ($images as $key => $value) {
  echo '<p>';
  echo '<img src="img/' . $key . '.jpg" alt="' . $value . '">';
  echo '</p>';
}

```



#### 入力フォームの作成


##### フォームの基本構造
- formタグ
	- formタグが持つ属性
		- action属性(必須)：パス - 値の送信先をパスで指定する
		- method属性：送り方の指定(主に「get」か「post」になる)、省略可（省略時はgetになる）

```html
<form action="http://terahouse-ica.ac.jp/" method="get">
  <!-- fromタグ
formタグ
この中にフォームパーツを配置して、そのパーツで入力されたり、選択されたものを指定したページに送るためのタブ


   -->
```

- fieldsetタグ
	- formパーツをグループごとにまとめて囲むときに使用する

- legendタグ
	- fieldsetタブで囲んだグループの題名をつけるためのタグ

- inputタグ
	- inputタグはtype属性というものを持つ。
	- type属性の値によって出来上がるパーツがことなる。
	- それぞれのtypeによってそのほかに必要な属性も変わる。

	- name属性(必須)：送信する際の名前を付けるための属性
	- 任意属性
		- value属性:初期値
		- placeholder属性:説明「ここに名前を入力してください」など薄いグレーで表示されるやつ。入力すると消える。


	- type属性の値でパーツの動きや形がことなる

- 入力系パーツ
	- 送信される値は「入力された値(全部文字列扱い)」
		- text
		- password など

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>フォームタグ</title>
</head>
<body>
<h1>inputタグ：入力系パーツ</h1>
<p>記述すべき属性：name属性（値の名前）</p>
<p>任意属性：value属性（初期値）, placeholder属性（説明）</p>
<form action="" method="get">
  <fieldset>
    <legend>基本</legend>
    <dl>
      <dt>type="text"</dt>
      <dd><input type="text" name="text"></dd>
      <dd><input type="text" name="text" value="初期値"></dd>
      <dd><input type="text" name="text" placeholder="プレースホルダー"></dd>
      <dt>type="password"</dt>
      <dd><input type="password" name="password"></dd>
    </dl>
  </fieldset>
  <fieldset>
    <legend>HTML5で追加された属性値</legend>
    <dl>
      <dt>type="search"</dt>
      <dd><input type="search" name="search"></dd>
      <dt>type="tel"</dt>
      <dd><input type="tel" name="tel"></dd>
      <dt>type="url"</dt>
      <dd><input type="url" name="url"></dd>
      <dt>type="email"</dt>
      <dd><input type="email" name="email"></dd>
      <dt>type="number"</dt>
      <dd><input type="number" name="number"></dd>
      <dt>type="date"</dt>
      <dd><input type="date" name="date"></dd>
      <dt>type="month"</dt>
      <dd><input type="month" name="month"></dd>
      <dt>type="week"</dt>
      <dd><input type="week" name="week"></dd>
      <dt>type="time"</dt>
      <dd><input type="time" name="time"></dd>
      <dt>type="datetime"</dt>
      <dd><input type="datetime" name="datetime"></dd>
      <dt>type="datetime-local"</dt>
      <dd><input type="datetime-local" name="datetime-local"></dd>
    </dl>
  </fieldset>
  <p><input type="submit" value="送信"></p>
  <p><input type="reset" value="リセット"></p>
</form>
</body>
</html>
```

- 選択系パーツ
	- type="radio":ラジオボタン
		- name属性：同じ名前にすることによりグループ化され、同じname属性の中から1つしか選択できないようにする。
		- value属性：ラジオボタン(type="radio")の場合、value属性の値が送信される。
		- checked属性(任意)：初期選択状態にする
	-  type="checkbox":チェックボックス
		- 複数選択可能
		- value属性：テキストボックス(type="checkbox")の場合も、value属性の値が送信される。
	- labelタグ
		- フォームの構成部品（一行テキストボックス・チェックボックス・ラジオボタン等）と、 その項目名（ラベル）を明確に関連付けるための要素。
		- これによりチェックボックスやラジオボタンでは、 関連付けられたテキスト部分をクリックしてもチェックを付けることができるようになる。
```html
// ラベルタグサンプル
        <label><input type="radio" name="group2" value="0"> G2項目１</label>
        <label><input type="radio" name="group2" value="1"> G2項目２</label>
        <label><input type="radio" name="group2" value="2"> G2項目３</label>
```

```html
// 選択系パーツサンプル
<form action="" method="get">
  <fieldset>
    <legend>ラジオボタン：グループ名の中から１つ選択</legend>
    <dl>
      <dt>type="radio"</dt>
      <dd>
        <label><input type="radio" name="group1" value="0"> G1項目１</label>
        <label><input type="radio" name="group1" value="1"> G1項目２</label>
        <label><input type="radio" name="group1" value="2"> G1項目３</label>
      </dd>
      <dd>
        <label><input type="radio" name="group2" value="0"> G2項目１</label>
        <label><input type="radio" name="group2" value="1"> G2項目２</label>
        <label><input type="radio" name="group2" value="2"> G2項目３</label>
      </dd>
      <dd>
        <label><input type="radio" name="group3" value="0" checked="checked"> G3項目１</label>
        <label><input type="radio" name="group3" value="1"> G3項目２</label>
        <label><input type="radio" name="group3" value="2"> G3項目３</label>
      </dd>
    </dl>
  </fieldset>
  <fieldset>
    <legend>チェックボックス：グループ名の中から複数選択</legend>
    <dl>
      <dt>type="checkbox"</dt>
      <dd>
        <label><input type="checkbox" name="group4[]" value="0"> G4項目１</label>
        <label><input type="checkbox" name="group4[]" value="1"> G4項目２</label>
        <label><input type="checkbox" name="group4[]" value="2"> G4項目３</label>
      </dd>
      <dd>
        <label><input type="checkbox" name="group5[]" value="0"> G5項目１</label>
        <label><input type="checkbox" name="group5[]" value="1"> G5項目２</label>
        <label><input type="checkbox" name="group5[]" value="2"> G5項目３</label>
      </dd>
      <dd>
        <label><input type="checkbox" name="group6[]" value="0" checked="checked"> G6項目１</label>
        <label><input type="checkbox" name="group6[]" value="1"> G6項目２</label>
        <label><input type="checkbox" name="group6[]" value="2"> G6項目３</label>
      </dd>
    </dl>
  </fieldset>
</form>
```



- ボタン系・隠しパーツ系
	- type="submit"
		- 送信ボタン：押下時にformタグのaction属性値に指定したパスに値を送信する。
		- type="submit"のvalue属性：ボタン上に表示する文字列
	- type="reset"
		- リセットボタン：このリセットボタンが配置されているformタグ内のフォームパーツの入力、選択状態を初期化する。
		- type="reset"のvalue属性：ボタン上に表示する文字列
	- type="button"
		- ただのボタン、汎用ボタン。JS等のイベントを関連付けるのに便利。
		- type="button"のvalue属性：ボタン上に表示する文字列

```html
// ボタン系サンプル
<form action="" method="get">
  <fieldset>
    <legend>入力パーツ</legend>
    <p>テキストボックス：<input type="text" name="text" value="初期値"></p>
    <p>隠しパーツ：<input type="hidden" name="secret" value="隠しパーツ"></p>
  </fieldset>
  <fieldset>
    <legend>ボタン系パーツ</legend>
    <dl>
      <dt>type="submit"</dt>
      <dd><input type="submit" value="送信"></dd>
      <dt>type="reset"</dt>
      <dd><input type="reset" value="リセット"></dd>
      <dt>type="button"</dt>
      <dd><input type="button" value="ただのボタン"></dd>
    </dl>
  </fieldset>
</form>
```

- セレクトボックス
	- select name="selectbox":プルダウンでメニューを表示して一個だけ選ばせる
	- optionタグで選択項目を書く
		- name属性(必須)：送信する値の名前
		- value属性(必須)：送信する値
		- selected属性(任意)：初期選択状態にする項目

```
//セレクトボックスサンプル
<form action="" method="get">
  セレクトボックス1：
  <select name="selectbox">
    <option value="1">選択項目１</option>
    <option value="2">選択項目２</option>
    <option value="3">選択項目３</option>
    <option value="4">選択項目４</option>
    <option value="5">選択項目５</option>
  </select>

  セレクトボックス2：
  <select name="selectbox">
    <option value="1">選択項目１</option>
    <option value="2">選択項目２</option>
    <option value="3" selected="selected">選択項目３</option>
    <option value="4">選択項目４</option>
    <option value="5">選択項目５</option>
  </select>
  <p><input type="submit" value="送信"></p>
  <p><input type="reset" value="リセット"></p>
</form>
```

##### 変化するvalue属性
- 入力系：初期値（最初から入力されている値
- 選択系・隠し系パーツ：送信される値
- ボタン系：ボタン内の文字


**HTMLのおすすめサイト**
Web関連の海外記事や最新情報、デザインなど情報を配信してくているサイト
[コリス](https://coliss.com/)



[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
