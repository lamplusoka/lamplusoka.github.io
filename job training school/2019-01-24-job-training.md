# 2019.1.24 授業内容

## Javascriptの続き

### 関数(function)とは
よく使う処理をまとめたものを関数(Function)という。  
一度定義してしまえばいつでも呼び出して使うことができる。  

- 関数は「定義」と「呼び出し」
	- 関数はよく使う処理をあらかじめ定義（記述）する
- 関数のバリエーション
	- 関数は状況に応じて以下の4種類を使い分けて定義
  
#### 1. 引数なし・戻り値なし関数
- 呼び出すといつも同じ処理をする（完結型）

```js
function 関数名(){
	呼び出されたときに実行する処理
}

// 関数を定義している
function attack() {
  console.log('攻撃した！！');
}
function guard() {
  console.log('防御している・・・');
}

//関数の呼び出し
attack();
guard();

//出力結果
攻撃した！！
防御している・・・
```

関数は呼び出している行から、関数を定義した行に戻って処理を実行→処理後に呼び出し行の次の行から処理を続行。  

#### 2. 引数あり・戻り値あり関数
- 関数に渡した値を使って処理する（完結型）

```js
function 関数名(引数 値受け取り用){
	呼び出されたときに実行する処理
}

function attack(name) {
  console.log(name + 'は攻撃した！！');
}
function guard(name) {
  console.log(name + 'は防御している・・・');
}
function magic(name, magicName) {
  console.log(name + 'は' + magicName + 'を唱えた！');
}

attack('田中');
guard('佐藤');
attack('鈴木');
attack();
magic('田中', 'メラム');


//出力結果
田中は攻撃した！！
佐藤は防御している・・・
鈴木は攻撃した！！
undefinedは攻撃した！！
田中はメラムを唱えた！
```


#### 3. 引数なし・戻り値あり関数
- 呼び出すといつも同じ処理をして結果を返す

##### 戻り値（返り値）とは
- return文を記述することで戻り値ありの関数を作成できる。  
- return文が実行されると値を関数呼び出し元に返す。
- もしreturn文が関数内処理の途中に記述されていた場合は、return文の処理行で関数の実行を終了し、以降の関数内処理は実行されない。

```js

function 関数名(引数 値受け取り用){
		呼び出されたときに実行する処理
		return 戻り値
}

function enemy() {
  console.log('ダメージを受けた！！');
  var point;
  point = Math.random() * 100;
  point = Math.ceil(point);
  console.log(point);
  return point;
}
function recovery() {
  var num = Math.random();
  console.log(num);
  if (num > 0.8) {
    console.log('大回復した');
    return 500;
  }
  console.log('回復した');
  return 200;
}

var life = 1000;

console.log('１回目の出力');
life -= enemy();
// life = life - enemy();
// enemy()の呼び出し
// enemy()に戻り値が返ってくる
// 戻り値を使って減算代入


console.log(life);

console.log('２回目の出力');
life += recovery();
console.log(life);

//出力結果
１回目の出力
ダメージを受けた！！
84
916
２回目の出力
0.8683273670733147
大回復した
1416

```


#### 4. 引数あり・戻り値あり関数
- 関数に渡した値を使って処理をして結果を返す

```js

function 関数名(引数 値受け取り用){
		呼び出されたときに実行する処理
		return 戻り値
}

function enemy(name) {
  var point;
  point = Math.random() * 100;
  point = Math.ceil(point);
  console.log(name + 'は' + point + 'ダメージを受けた！！');
  return point;
}
function recovery(name, magicID) {
  var magicName;
  var point;
  switch (magicID) {
    case 1:
      magicName = 'ホイム';
      point = 100;
      break;
    case 2:
      magicName = 'ベホイム';
      point = 200;
      break;
    case 3:
      magicName = 'ベホムズン';
      point = 300;
      break;
  }
  console.log(name + 'は' + magicName + 'を唱えた！' + point + '回復');
  return point;
}

var playerList = [
  {name: '田中', life: 1000},
  {name: '佐藤', life: 500},
];

console.log('１回目の出力');
playerList[0].life -= enemy(playerList[0].name);
console.log(playerList[0].life);

console.log('２回目の出力');
playerList[0].life += recovery(playerList[0].name, 1);
console.log(playerList[0].life);
```

#### switch文の使い方
switch文は式の値に応じて複数の選択肢から一致する箇所の処理を実行するもの。
「式の値」と「caseの値」は厳密等価演算子「===」で確認する。

```js
switch(式の値){
	case 値1:   // case のあとはコロン「：」。セミコロンではない。
		値1と合致した時の処理
		break;
	case 値2:
		値2と合致した時の処理
		break;
	default:   // 省略可。どの処理にも合致しなかった場合何もしない。
		どのcaseにも該当しなかったときの処理
		break;
}

var num = 3;

console.log('１回目の出力');
switch (num) {
  case 1:
    console.log('1の処理');
    break;
  case 2:
    console.log('2の処理');
    break;
  case 3:
    console.log('3の処理');
    break;
  default:
    console.log('該当なしの処理');
    break;
}

console.log('２回目の出力');
switch (num) {
  case '1':
    console.log('1の処理');
    break;
  case '2':
    console.log('2の処理');
    break;
  case '3':
    console.log('3の処理');
    break;
  default:
    console.log('該当なしの処理');
    break;
}

console.log('３回目の出力');
var text = '赤';
switch (text) {
  case '黒':
    console.log('規律');
    break;
  case '赤':
    console.log('活発');
    break;
  case '緑':
    console.log('信頼');
    break;
}

//出力結果
１回目の出力
3の処理
２回目の出力
該当なしの処理
３回目の出力
活発
```

### スコープとは
スコープとは変数の参照範囲のことを言う。作成（宣言）した変数が使える範囲（有効範囲）は  
どこまでなのか把握しておこう。  
スコープは変数宣言の仕方で変わってくる。  

#### スコープの種類
グローバルスコープとローカルスコープの2種類。  
ローカルスコープ内に関数スコープとブロックスコープ（ES2015以降実装）に分かれる。  

##### 変数宣言の種類
- 未宣言変数
	- グローバル変数になる
- var 変数名
	- 変数
		- 宣言した場所でグローバル変数にもローカル変数にもなる
		- 同じスコープ内で同名変数の宣言ができる
		- Windowsオブジェクトに登録される
- let 変数名
	- 局所変数
		- 宣言した場所でグローバル変数にもローカル変数にもなる
		- 同じスコープ内で同名変数の宣言ができない
		- ブロックスコープをもつ変数
- const 変数名
	- 定数
		- 宣言した場所でグローバル変数にもローカル変数にもなる
		- 同じスコープ内で同名変数の宣言ができない
		- ブロックスコープをもつ変数
		- 読み取り専用：再代入による値の変更は不可

#### グローバルスコープ（グローバル変数）

```js
function test() {
  console.log('関数内:' + num);
//関数内から関数外の変数を参照
//グローバル変数は参照可能

}

console.log('１回目の出力');
var num = 100;
//変数宣言
//関数外で宣言された変数はグローバルスコープをもつグローバル変数
//どこからでも参照できる変数

console.log('関数外:' + num);
test();

```

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
