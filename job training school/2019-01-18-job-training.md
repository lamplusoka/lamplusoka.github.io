# 2019.1.18 授業内容

## JavaScript 続き

### 多次元配列の使い方
配列の部屋の中にさらに配列を入れて管理することを多次元配列と呼ぶ。  
グループ化した大量のデータを一つの変数で扱えるため便利。  

```js
var score = [
  [60, 90], //0番地：１人目の試験結果
  [20, 50, 95], //1番地：２人目の試験結果
  [100], //2番地：３人目の試験結果
];
```
※一番最後の配列の後の「,」はあってもなくてもよいが、あったほうがよい。  
後々追加する際に便利なため。  

#### 2次元配列の値を使用（参照）する
```js
console.log(score[1].length);
console.log(score[1][0]);
console.log(score[1][score[1].length - 1]);
```


### オブジェクトの使い方
#### オブジェクトとは
名前を付けた箱（プロパティ）に複数の値を保存してまとめた集合体のことをオブジェクトという。  
オブジェクトは主にある物事に関する複数のデータをまとめて管理する際に使用される。  
尚、**オブジェクトには配列で利用できた「length」が存在しないため注意。**


```js
var 変数名 = {プロパティ名1:値1, プロパティ名2:値2, ・・・}
var player1 = {
  name: '田中',
  job: '勇者',
  maxLife: 1000,
  life: 1000,
};
```

#### オブジェクト内の値を使用（参照）する
```js
console.log(player1);
console.log(player1.name);
console.log(player1.life);
console.log(player1.job);
```

### JSON(JavaScript Object Notation)の使い方
JSON(JavaScript Object Notation)はJavaScriptの配列とオブジェクトを使って記述されたデータ形式のこと。  

詳細は教科書で自習！  
  

### データ型
- 基本型
	- 文字列型:String
	- 数値型:Number
	- 真偽型:Boolean
	- 未定義型:Undefined
	- Null型:Null
- 参照型
	- オブジェクト型:Object
	- 関数型:Function

#### データ型を調べる
typeof 変数名

```js
x = 'メッセージ';

console.log(x);
console.log(typeof x);
```

#### 文字列連結演算子
左辺と右辺の値の**データ型を文字列型に変更**した後、文字列同士を連結する。  

```js
var name = '田中';
console.log('こんにちは' + name + 'さん');
console.log(name + 200); → 結果 田中200
```


#### 算術演算子
|演算子|名称|内容|
|-|-|-|
|+|加算演算子|数値同士を足し算する|
|-|減算演算子|数値同士を引き算する|
|*|乗算演算子|数値同士を掛け算する|
|/|除算演算子|数値同士を割り算する|
|%|剰余演算子|数値同士を割り算した余りを出す|

**左から順番に処理される**  
1. '答えは' + 4 → '答えは4' 左側が文字列型のため、4も文字列型へ変更される。
2. '答えは' + 4 + 2 → '答えは42' 同じく左側の'答えは4'が文字列型のため、2も文字列型へ変更される。
「()丸カッコ」で囲み処理の優先度を上げることが可能。

`console.log('答えは' + (4 + 2();` → 結果：答えは6

#### NaN(Not a Number):計算不可能な式の結果
`console.log('答えは' + 4 - 2);` → 結果：NaN  
'答えは4'が文字列型になる→-2は文字列にならない→左側「'答えは4'」を数値型に変換しようとするが変換できず。NaNとなる。  

```js
console.log('１回目の出力');
console.log('10' + '20');
console.log('10' + 20);
console.log(10 + '20');
console.log(10 + 20);

console.log('２回目の出力');
console.log('10' - '20');
console.log('10' - 20);
console.log(10 - '20');
console.log(10 - 20);
console.log('10個' - 20);

結果
１回目の出力
1020
1020
1020
30


２回目の出力
-10
-10
-10
-10
NaN
```

#### 外部から取得した値はすべて文字列型
JavaScriptに限らずほとんどのプログラム言語は外部から取得した値を文字列型として扱う。  

### インクリメント・デクリメント演算子
- 前置置換： ++変数名
- 後置置換： 変数名++


```js
var num = 10;

console.log('１回目の出力');
console.log(num);
++num;
console.log(num);
num++;
console.log(num);

num = 10;

console.log('２回目の出力');
console.log(num);
console.log(++num);
console.log(num);
console.log(num++);//12かとおもいきや11で出力
// インクリメント演算子が後のついているときは処理した後加算
console.log(num);

num = 10;

console.log('３回目の出力');
console.log(num);
--num;
console.log(num);
num--;
console.log(num);

num = 10;

console.log('４回目の出力');
console.log(num);
console.log(--num);
console.log(num);
console.log(num--);
console.log(num);

■結果
１回目の出力
10
11
12
２回目の出力
10
11
11
11
12
３回目の出力
10
9
8
４回目の出力
10
9
9
9
8
```



<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)


