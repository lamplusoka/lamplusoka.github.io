# 2019.2.7 授業内容

## PHPの続き

### セキュリティ対策
#### クロスサイトスクリプティング（XSS）
クロスサイトスクリプティングは、エンドユーザー側がWebページを制作することのできる  
動的サイト（例：Twitter、掲示板等）に対して、自身が制作した不正なスクリプトを挿入するサイバー攻撃です。  
直接的な被害は標的サイトではなく、サービスを利用しているエンドユーザーに対して及びます。  
標的になったサイトとは別のサイトに情報を送信（クロス）することから、この名前で呼ばれるようになりました。

- 特にJavaScriptのコードを書けるということは、JavaScriptが行えることは何でも出来てしまうことになる。

```php
// form1.php 送信元

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>値を送信</title>
</head>
<body>
<h1>値を送信</h1>
<form action="confirm1.php" method="post">
<textarea name="text" rows="5" cols="30"></textarea>
<p><input type="submit" value="送信する"></p>
</form>
<h2>ブラウザをクラッシュさせる</h2>
<pre>
&lt;script type="text/javascript"&gt;
for(var i=0;i<5;i++){
  alert('悪意あるスクリプト');
}
&lt;/script&gt;
</pre>
<h2>ページを移動させる</h2>
<pre>
&lt;script type="text/javascript"&gt;
location.href='http://www.terahouse-ica.ac.jp/';
&lt;/script&gt;
</pre>
<h2>ページを書き換えてしまう</h2>
<pre>
&lt;script type="text/javascript"&gt;
window.onload=function(){
  var html = '&lt;h1&gt;○○銀行&lt;/h1&gt;';
  html += '&lt;form action="#"&gt;';
  html += '&lt;p&gt;&lt;label&gt;ユーザ名：';
  html += '&lt;input type="text" name="user"&gt;&lt;/label&gt;&lt;/p&gt;';
  html += '&lt;p&gt;&lt;label&gt;パスワード：';
  html += '&lt;input type="password" name="pass"&gt;&lt;/label&gt;&lt;/p&gt;';
  html += '&lt;p&gt;&lt;input type="submit" value="送信"&gt;&lt;/p&gt;';
  html += '&lt;/form&gt;';
  document.write(html);
}
&lt;/script&gt;
</pre>
</body>
</html>





//confirm1.php 受け手側

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>フォームから送信された値を取得</title>
</head>
<body>
<h1>フォームから送信された値を取得</h1>
<p>-----ここから受け取った値を表示-----</p>
<?php
if(isset($_POST['text'])){
  echo '<p>';
  echo $_POST['text'];
	// "入力内容にタグと認識できるものを入れられるとタグとして機能してしまう"
	// "こんにちは
	// <span style="color:red">田中です</span>" ⇒ こういったものが機能してしまう

	// 問題はユーザーが入力してきた文字列の中の「<」と「>」をタグとみなしてしまう
	// HTML上意味のある記号をhtmlとして解釈してしまうことで意図しない状態になってしまう
	// ⇒ユーザーが入力してきた文字列の中にあるhtml上意味のある記号をhtmlとして認識しないように実体参照に置き換える
	// < ⇒ &lt; > ⇒ &gt;

	// サニタイジング
	// htmlspecialchars(実体参照に置き換えてほしい文字列)
 

  echo '</p>';
}
?>
<p>-----ここまで受け取った値を表示-----</p>
<p><a href="form1.php">フォームに戻る</a></p>
</body>
</html>
```

##### HTMLで意味をもつ記号をエスケープする
`htmlspecialchars(実体参照に置き換えてほしい文字列,intオプション,)`  
`echo htmlspecialchars($_POST['text']);`  
こうやってきれにすることを**サニタイジング**という
- サニタイジングのタイミング
	- 出力する直前でサニタイジングすること
	- 値を受け取ったタイミングでサニタイジングすると、後から値が追加された場合に再度サニタイジングする必要が出てくる。  
処理が分散してしまい、サニタイジング忘れや重複してサニタイジングしてしまう可能性があるため


##### 変数出力位置の注意
以下のような場所に変数の内容を出力するとhtmlspecialchars()関数でのエスケープ処理が意味を持ちません。このような記述はやめましょう。  

1. href属性値部分への変数出力
	- 例）`<a href="<?php echo $link; ?>">`
	- 例）`<a href="javascript:コード">`
		- 疑似プロトコルというJavaScriptの記述方法
		- aタグ等のhref属性の値としてJavaScriptのコードを記述する書き方
		- JavaScript：から始めて、後ろにJavaScriptのコードを記述することでクリックした際にそのjavascrptを動かすことができる
		- javascrpt:void(0)
		- そのタグに規定された標準挙動をキャンセルする
		- aタグがクリックされたらリンク先に遷移する動きをキャンセルする
2. scriptタグ内への変数出力
	- 例）`<script type="text/jabascript><?php echo $script; ?></script>`
3. styleタグ内への変数出力
	- 例）`<style type="text/css><?php echo $css; ?></script>`


##### セッションハイジャック
セッションはクッキーでセッションIDを送受信してユーザーを認識している。  
もし悪意のあるユーザーにセッションIDを取得されてしまうと正しいユーザーができることを  
悪意のあるユーザーが本人になりすまし操作できるようになってしまう。  
このようなセッションID乗っ取りをセッションハイジャックと呼ぶ。
- 対処法
	- 予測できない文字列のセッションID発行
	- クッキーの有効期限を短くする
	- サイトにアクセスするたびにセッションIDをあたらに発行する方法など

- セッションIDの再発行
	- session_regenerate_id(boolセッションファイルの削除)

### 関数の作成

よく使う処理を関数として登録しておくことでプログラムの記述が楽になる。

```php
//function2.php

<?php
function h($str){
  $html = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  return $html;
}
// function 関数名(引数){
// 関数内の処理
// }

// 業界ではhtmlspecialcharsの関数名をhにしていることが多い。

// 引数：関数外から受け取る値を入れておく変数
// 関数内では外部から受け取った値を名前で扱えるようにしておく

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>オリジナル関数の定義</title>
</head>
<body>
<h1>オリジナル関数の定義</h1>
<p>
<?php
$text = '<span style="font-size: 100px;">文字列</span>';
echo '$text:' . $text . '<br>';
$html = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
// ENT_QUOTES:ダブルクォート、シングルクォートの両方を変換します。

echo '$html:' . $html . '<br>';
?>
</p>
</body>
</html>
```

■関数をさらにカスタマイズ

```php
<?php
function h($str){
  if(is_array($str)){
    return array_map('h', $str);
		// array_map(第一引数、第二引数)
		//第一引数：関数の名前（文字列）
		//第二引数：処理の対象となる配列

		// 配列の各部屋に対して、第一引数で指定した関数の処理を実行して、
		// その結果を新しい配列に入れて返す
		// コールバック関数：関数の引数として呼び出される関数のこと
		// 関数定義の中でその関数自信を呼出す ⇒ 再帰処理

  }else{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}
?>
```


#### よく使う関数を外部ファイル化する
よく使う関数を外部ファイル化することで、ほかのPHPファイルでも読み込んで使用することができる。

```php
//function4.php
<?php
require_once dirname(__FILE__). '/functions.php';
// __FILE__ : PHPの定数。このファイルのフルパスとファイル名を持っている。(C:\Users\ica\Desktop\xammp\htdocs\sample\original\function4.php)
// dirname(引数):引数に指定したファイルやフォルダの親ディレクトリを取得する。(C:\Users\ica\Desktop\xammp\htdocs\sample\original)
// dirname(__FILE__)：自分（このファイル）の親ディレクトリを絶対パスで取得する記述。


?>
```
```php
// functions.php

<?php
function h($str){
  if(is_array($str)){
    return array_map('h', $str);
  }else{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}

```
**関数定義の外部ファイルはPHPブロックを「?>」で閉じなくてよい。**
- html上で「?>?>」と二つあると改行されることがある。


### 正規表現

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
	// 	チェック中に問題が発生したらfalseを返す


  echo '郵便番号です。';
}else{}
  echo '郵便番号ではありません。'；
?>
</p>
</body>
</html>
```


[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  


[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
