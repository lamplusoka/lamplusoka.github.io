# 2019.2.4 授業内容

## PHPの続き

### 値を送信
#### GET/POST形式で値を送信1


- method属性：getの場合
	- URLを使って値を送信
	- action属性で指定したURLにクエリ文字列を付加して送信する。
	- クエリ文字列は「?名前=値」の形式。複数の場合は「?名前1=値1&?名前2=値2」」のようにつなぐ。
	- アドレス欄に送信する値が表示されるため、値を盗み見られたり値を書き換えることが容易にできてしまうため注意。
	- パスワードなどを送る場合は大抵POSTを使う。
	- 共有してよいもの、公開しても問題ないものはGETで送る。
		- 情報量の制限について
			- URLの長さに上限を設けているブラウザがあるので、URLにクエリ文字列を追加した結果、  
		上限を超えるような長さになる場合は送信できなくなる。  
		- $_GET（ゲット変数）
			- $_GET(ゲット変数)を利用することで、URLの値を受信して処理することが出来る
			- $_GET は PHPの定義済み変数(=スーパーグローバル変数)の1つ
			- $_GET は HTTP GET メソッド で送信され、URLパラメーターとして送られてきた値を取得する変数
			- $_GET は 連想配列として使用する
			- $_GET は urldecode()関数を介した値が渡される
			- $_GET は、関数やメソッドの内部で使用する場合、global $_GET; とする必要がない

- method属性：postの場合
	- URL欄には送り先のページのアドレスしかない。
	- 送ったものの名前や値は、URLではわからない。
	- パスワードなどを送る場合は大抵POSTを使う。
	- リクエストはリクエストヘッダとリクエストボディで構成されており、  
POST形式の場合はリクエストボディを使用して入力データを送信する。
	- 情報量の制限について
		- 基本的に情報量の制限はなし。
		- 不当に大きなリスエストを受け付けないようにサーバー側でブロックしている場合もあり。


```html
// GETサンプル1

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GET形式で値を送信１</title>
</head>
<body>
<h1>GET形式で値を送信１</h1>
<form action="32_confirm_get1.php" method="get">
  <h2>性別は？</h2>
  <label><input type="radio" name="gender" value="1">男性</label>
  <label><input type="radio" name="gender" value="2">女性</label>

  <h2>年齢は？</h2>
  <select name="age">
    <option value="0" selected="selected">選択してください</option>
    <option value="1">10代</option>
    <option value="2">20代</option>
    <option value="3">30代</option>
    <option value="4">40代</option>
    <option value="5">50代以上</option>
  </select>
<p>
  <input type="submit" value="投票する">
</p>
</form>
</body>
</html>
```


```php
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GET形式で送信された値を取得１</title>
</head>
<body>
<h1>GET形式で送信された値を取得１</h1>
<?php
echo '<h2>$_GET</h2>';
echo '<pre>';
var_dump($_GET);
echo '</pre>';

echo 'GETで送信された値を出力<br>';
if(isset($_GET['gender'])){
		// isset(引数)
		// 引数になっている変数が存在するかを確認する関数
		// 存在する場合はtrue、しない場合はfalseを返す


  echo '$_GET[\'gender\']:' . $_GET['gender'] . '<br>';
}
if(isset($_GET['age'])){
  echo '$_GET[\'age\']:' . $_GET['age'] . '<br>';
}
$japan = [
      'fujiyama' => '山梨',
      'samurai' => '侍ね',
      'tenpura' => '脂っこい',
      ];
var_dump($japan);
?>
<p><a href="32_form_get1.html">フォームに戻る</a></p>
</body>
</html>
```

#### phpマニュアルの見方
[isset](http://php.net/manual/ja/function.isset.php)  
- `isset ( mixed $var [, mixed $... ] ) : bool`
	- mixed:データ型はなんでもいいよ
	- [, mixed $... ]:省略してもいいよ、複数指定する場合は.で区切って続けてよ
	- bool:var が存在して NULL 以外の値をとれば TRUE、 そうでなければ FALSE を返します。

■GET形式で送信された複数の値を取得  

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GET形式で値を送信２</title>
</head>
<body>
<h1>GET形式で値を送信２</h1>
<form action="34_confirm_get2.php" method="get">
<h2>趣味は？</h2>
<label><input type="checkbox" name="hobby[]" value="1">音楽鑑賞</label>
<label><input type="checkbox" name="hobby[]" value="2">映画鑑賞</label>
<label><input type="checkbox" name="hobby[]" value="3">ドライブ</label>
<label><input type="checkbox" name="hobby[]" value="4">旅行</label>
<label><input type="checkbox" name="hobby[]" value="5">その他</label>

<!-- HTML上では意味はないが、受け取ったphp側で配列を作らせるために
		 name属性の値に「」をつける。
		 受け取ったPHPではname[]の表現は、nameという配列に新しい部屋を作成するという意味になる。-->

<p>
<input type="submit" value="投票する">
</p>
</form>
</body>
</html>
```

```php
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GET形式で送信された値を取得２</title>
</head>
<body>
<h1>GET形式で送信された値を取得２</h1>
<?php
echo '<h2>$_GET</h2>';
echo '<pre>';
var_dump($_GET);
echo '<pre>';

if(isset($_GET['hobby'])){
  echo 'GET形式で送信した値を出力<br>';
  $getHobby = $_GET['hobby'];
  if(is_array($getHobby)){
    foreach ($getHobby as $value) {
      echo $value . '<br>' . "\n";
      # code...
    }
  }
}
?>
<p><a href="34_form_get2.html">フォームに戻る</a></p>
</body>
</html>
```

#### 外部から受け取った値を信用してはいけない

「＄_GET」や「＄_POST」で受け取った値が常に製作者の意図した値とは限りません。  
- 例
	- フォームから送信せずに直にクエリ文字列をアドレス欄に記述ることで悪意ある値を送信することが可能。
	- HTML内のフォームを改ざんすることでPOST形式で悪意ある値を送信することも可能。
	- 受け取った値を使用する場合は意図した値の範囲以内かどうか、必ずチェックするようにする。

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
