# 2019.1.18 授業内容

## JavaScript 続き

### 代入演算子

|名称|短縮表記した演算子|意味|
|-|-|-|
|代入|x = y|x = y|
|加算代入|x += y|x = x + y|
|減算代入|x -= y|x = x - y|
|乗算代入|x *= y|x = x * y|
|除算代入|x /= y|x = x / y|
|剰余代入|x %= y|x = x % y|


```js
var x =5;
var y = 10;
var z = 20;

x = y;　// 右辺の変数を変数y値10を、左辺変数xに代入
console.log('１回目の出力');
console.log(x);

x = y = z; // 右から処理される、まずy に z の20が代入される
console.log('２回目の出力');
console.log(x);

■結果

１回目の出力
10
２回目の出力
20
```

#### 文字列連結代入演算子

```js

var text1 = '2018年1月';
console.log('１回目の出力');
console.log(text1 + 'お正月');
console.log(text1); //変数の値は元のまま

var text2 = '2018年1月';
text2 = text2 + 'お正月'; //文字列連結した結果を変数に代入
console.log('２回目の出力');
console.log(text2);

var text3 = '2018年1月';
text3 += 'お正月'; //代入演算子で短く記述
console.log('３回目の出力');
console.log(text3);

■結果
１回目の出力
2018年1月お正月
2018年1月
２回目の出力
2018年1月お正月
３回目の出力
2018年1月お正月
```

#### 加算代入演算子

```js
var num = 10;
console.log('加算：１回目の出力');
console.log(num + 20);
console.log(num); //変数の値は元のまま

num = 10;
num + 20; //加算しただけ:結果も処理に使っていない（無駄な処理
console.log('加算：２回目の出力');
console.log(num);

num = 10;
num = num + 20; //加算した結果を変数に代入
console.log('加算：３回目の出力');
console.log(num);

num = 10;
num += 20; //代入演算子で短く記述
console.log('加算：４回目の出力');
console.log(num);

/* ---------------- */

num = 10;
console.log('減算：１回目の出力');
console.log(num - 20);
console.log(num); //変数の値は元のまま

num = 10;
num - 20; //減算しただけ:結果も処理に使っていない（無駄な処理
console.log('減算：２回目の出力');
console.log(num);

num = 10;
num = num - 20; //減算した結果を変数に代入
console.log('減算：３回目の出力');
console.log(num);

num = 10;
num -= 20; //代入演算子で短く記述
console.log('減算：４回目の出力');
console.log(num);

/* ---------------- */

num = 10;
console.log('乗算：１回目の出力');
console.log(num * 20);
console.log(num); //変数の値は元のまま

num = 10;
num * 20; //乗算しただけ:結果も処理に使っていない（無駄な処理
console.log('乗算：２回目の出力');
console.log(num);

num = 10;
num = num * 20; //乗算した結果を変数に代入
console.log('乗算：３回目の出力');
console.log(num);

num = 10;
num *= 20; //代入演算子で短く記述
console.log('乗算：４回目の出力');
console.log(num);

/* ---------------- */

num = 10;
console.log('除算：１回目の出力');
console.log(num / 4);
console.log(num); //変数の値は元のまま

num = 10;
num / 4; //除算しただけ:結果も処理に使っていない（無駄な処理
console.log('除算：２回目の出力');
console.log(num);

num = 10;
num = num / 4; //除算した結果を変数に代入
console.log('除算：３回目の出力');
console.log(num);

num = 10;
num /= 4; //代入演算子で短く記述
console.log('除算：４回目の出力');
console.log(num);

/* ---------------- */

num = 10;
console.log('剰余：１回目の出力');
console.log(num % 4);
console.log(num); //変数の値は元のまま

num = 10;
num % 4; //余り算しただけ:結果も処理に使っていない（無駄な処理
console.log('剰余：２回目の出力');
console.log(num);

num = 10;
num = num % 4; //余り算した結果を変数に代入
console.log('剰余：３回目の出力');
console.log(num);

num = 10;
num %= 4; //代入演算子で短く記述
console.log('剰余：４回目の出力');
console.log(num);

/* ---------------- */

■結果
加算：１回目の出力
30
10
加算：２回目の出力
10
加算：３回目の出力
30
加算：４回目の出力
30
減算：１回目の出力
-10
10
減算：２回目の出力
10
減算：３回目の出力
-10
減算：４回目の出力
-10
乗算：１回目の出力
200
10
乗算：２回目の出力
10
 乗算：３回目の出力
200
乗算：４回目の出力
200
除算：１回目の出力
2.5
10
除算：２回目の出力
10
除算：３回目の出力
2.5
除算：４回目の出力
2.5
剰余：１回目の出力
2
10
剰余：２回目の出力
10
剰余：３回目の出力
2
剰余：４回目の出力
2
```


```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>代入演算子：ステップアップ</title>
</head>
<body>
<h1>代入演算子：ステップアップ</h1>
<div class="box">
  <input type="button" value="大" onclick="bigSize();"> → onclick属性：クリック時JSを呼び出す
  <input type="button" value="小" onclick="smallSize();">
</div>
<div id="change" class="box">
  <p>フォントサイズ：<span id="display1">？</span></p>
</div>
<script src="assignment_operator3.js"></script>
</body>
</html>
```

```js

//ページ読み込み時に実行
var size = 16;
var step = 5;
document.getElementById('display1').innerHTML = size;
// document.getElementById('display1')：()内のIDを使ってHTML要素を取得 ID名display1のHTML要素を取得

// .innerHTML：HTML要素内を意味する

console.log(size);
document.getElementById('change').style.fontSize = size + 'px';
// document.getElementById('change')：ID名changeのHTML要素を取得

// .style.fontSize：css(インライン)のfont-sizeプロパティ(-ハイフンはjsではマイナスの意味があるので使えない)


// 「大」ボタンを押したときに実行
function bigSize(){
  console.log('「大」ボタンが押されました');
  size += step;
// 変数sizの値に変数stepの5を足しこむ
  document.getElementById('display1').innerHTML = size;

  console.log(size);
  document.getElementById('change').style.fontSize = size + 'px';


}

// 「小」ボタンを押したときに実行
function smallSize(){
  console.log('「小」ボタンが押されました');
  size -= step;
  document.getElementById('display1').innerHTML = size;
  console.log(size);
  document.getElementById('change').style.fontSize = size + 'px';
}
```

### エスケープシーケンス

#### エスケープシーケンスの一覧
|エスケープシーケンス|意味|
|-|-|
|\b|バックスペース|
|\t|水平タブ|
|\v|垂直タブ|
|\n|改行  出力先で改行される。|※ブラウザ上では改行されない。
|\r|復帰|
|\f|改ページ|
|\\'|シングルクオーテーション|
|\\"|ダブルクオーテーション|
|\\\ | \\文字 |


### プログラムの基本処理
プログラミングにおける3つの基本処理
1. 順次処理：上から順番にプログラムを実行します
2. 分岐処理：条件に当てはまる場合に実行します
3. 反復処理：条件が成立する間、同じ処理を繰り返して実行します

#### 分岐処理
- if文：条件の成否で2つの選択肢から1つを選択する
- switch文：値を使って複数の選択肢から処理を選択する
- 三項演算子：条件の成否で2つの処理や値から1つを選択する


#### 反復処理
- while文：最初に条件を確認して繰り返し処理を実行する
- do while文：最後に条件を確認して繰り返し処理を実行する
- for文：繰り返し回数を決めて処理を実行する


### 比較演算子

|比較演算子|意味|使用例|結果|
|-|-|-|-|
|>|左辺が右辺よりも大きい|8 > 2|true|
|>=|左辺が右辺より大きいか同じ|3 >= 3|true|
|<|左辺より右辺が大きい|7 > 4|false|
|<=|左辺より右辺が大きいか同じ|3 <= 6|true|
|==(等価演算子)|左辺と右辺の値が同じ データ型はよしなにしてくれる|‘7’ > 7|true|
|===(厳密等価演算子)|左辺と右辺の値と型がおなじ(データ型も比較)|‘7’ === 7|false|
|!===(厳密不等価演算子)|左辺と右辺の値と型が異なる場合に真を返す|‘7’ !=== 7|true|
|!==|	左辺と右辺が異なる データ型が等しくない場合も真を返す|‘7’ !== 7|false|

```js
var num = 10;

console.log('１回目の出力');
console.log(num === 10);
console.log(num === '10');
console.log(num === 5);
console.log(num === '東京');

console.log('２回目の出力');
console.log(num == 10);
console.log(num == '10');
console.log(num == 5);
console.log(num == '東京');

console.log('３回目の出力');
console.log(num !== 10);
console.log(num !== '10');
console.log(num !== 5);
console.log(num !== '東京');

console.log('４回目の出力');
console.log(num != 10);
console.log(num != '10');
console.log(num != 5);
console.log(num != '東京');

console.log('５回目の出力');
console.log(num < 10);
console.log(num < '10');
console.log(num < 5);
console.log(num < '東京');

console.log('６回目の出力');
console.log(num <= 10);
console.log(num <= '10');
console.log(num <= 5);
console.log(num <= '東京');

console.log('７回目の出力');
console.log(num > 10);
console.log(num > '10');
console.log(num > 5);
console.log(num > '東京');

console.log('８回目の出力');
console.log(num >= 10);
console.log(num >= '10');
console.log(num >= 5);
console.log(num >= '東京');

console.log(1 < 'A');
console.log('Aあ' < 'Aい');

■結果
１回目の出力
true
false
false
false
２回目の出力
true
true
false
false
３回目の出力
false
true
true
true
４回目の出力
false
false
true
true
５回目の出力
false
false
false
false
６回目の出力
true
true
false
false
７回目の出力
false
false
true
false
８回目の出力
true
true
true
false
false
true

```

### if文・論理演算子
#### ブロックとインデント
ブロック内は必ずインデントしよう。  
インデントしなくてもエラーにはならないが、見づらいプログラムになってしまうため。  

#### if文

```js
var age = 20;
if (age < 20) {
  console.log('未成年');
}
```

#### if else 文

```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>if else 文</title>
</head>
<body>
<h1>if else 文</h1>
<script src="if_else.js"></script>
</body>
</html>
```

```js
var age = 16;

if (age < 20) {
  console.log('未成年');
} else {
  console.log('成人');
}
```

#### if else if 文

```js
var num = 30;

if (num < 20) {
  console.log('20より小さい');
} else if(num < 40) {
  console.log('20以上40より小さい');
} else {
  console.log('40以上');
}
```

■ステップアップ問題

```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>BMI計算</title>
</head>
<body>
<h1>BMI計算</h1>
<div class="box">
  <p>BMI（ボディマス指数 Body Mass Index：肥満指数）で標準体重を計算</p>
  <p>計算式：BMI＝体重kg ÷ (身長m Ｘ 身長m)</p>
  <p>身長：<input id="height" type="text" size="5">cm</p>
  <p>体重：<input id="weight" type="text" size="5">kg</p>
  <p><input type="button" value="BMI計算" onclick="displayMessage();"></p>
  <table border="1">
    <tr>
      <th>BMI</th><th>判定</th>
    </tr>
    <tr>
      <td>18.5未満</td><td>低体重</td>
    </tr>
    <tr>
      <td>18.5～25未満</td><td>普通体重</td>
    </tr>
    <tr>
      <td>25～30未満</td><td>肥満（１度）</td>
    </tr>
    <tr>
      <td>30～35未満</td><td>肥満（２度）</td>
    </tr>
    <tr>
      <td>35～40未満</td><td>肥満（３度）</td>
    </tr>
    <tr>
      <td>40以上</td><td>肥満（４度）</td>
    </tr>
  </table>
</div>
<div class="box">
  <p id="display1">表示箇所</p>
</div>
<script src="bmi.js"></script>
</body>
</html>
```

```js
function displayMessage() {
  var height = document.getElementById('height').value;
// document.getElementById('height'):身長入力欄
// .value:入力値
//身長入力欄の入力値を変数heightに代入

  var weight = document.getElementById('weight').value;
// document.getElementById('weight'):身長入力欄
// .value:入力値
//身長入力欄の入力値を変数weightに代入


  console.log('height:' + height);
  console.log('weight:' + weight);

  var result = weight / ((height/100) * (height/100))
// 変数resultに計算結果のBMI値が代入される（割り算・掛け算）はJavaScriptが自動で文字型を整数型に変更してくれる。

  var message = 'BMIの数値は「' + result + '」で';
  if (true) {
    message += '「」';
  }
  message += 'です';
  document.getElementById('display1').innerHTML = message;
}
```




[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
