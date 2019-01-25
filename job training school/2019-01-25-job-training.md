# 2019.1.25 授業内容

## Javascriptの続き

### グローバルスコープの続き

```js
function recoveryMagic(playerID, magicID) {
  console.log(playerList[playerID].name + 'は'
   + magicList[magicID].name + 'を唱えた！'
   + magicList[magicID].point + '回復');
  return magicList[magicID].point;
}


//関数外でvarを使って宣言：グローバル変数
//グローバルスコープを持ちどこからでも参照可能
// ■メリット
// プログラム全体で使用する値を記述できる
// ■デメリット
// どこからでも参照できるので、うっかり値をかえてしまったりするバグが発生しやすい
var playerList = [
  {name: '田中', life: 1000},
  {name: '佐藤', life: 500},
];
var magicList = [
  {name: 'ホイム', point: 100},
  {name: 'ベホイム', point: 200},
  {name: 'ベホムズン', point: 300},
];

console.log('１回目の出力');
playerList[0].life += recoveryMagic(0, 1);
console.log(playerList[0].life);
```

### ローカルスコープ（ローカル変数）
- 宣言したブロック「{}中カッコ」内でのみ利用できる変数。  
- 不用意に値変更をすることがなくバグ回避できる。  
- 有効範囲から外れた変数はメモリ領域から解放され、メモリ消費を軽減させる役割もある。
- 状況に応じてグローバル変数とローカル変数を使い分ける。

#### 関数スコープ

```js
function test() {
	// 関数ブロック内でvarを使って宣言：ローカル変数
	// ブロック内でのみ使用可能
	// 関数内で宣言した変数はローカルスコープを持つローカル変数
  var num = 100;
  console.log('関数内:' + num);
}

console.log('１回目の出力');
test();
console.log('関数外:' + num);


//出力結果
１回目の出力
関数内:100
Uncaught ReferenceError: num is not defined at function_scope1.js:8


```

#### グローバルスコープとローカルスコープに同名変数
グローバルスコープとローカルスコープに同じ名前の変数が存在する場合、グローバルスコープがローカルスコープから利用できなくなり、ローカルスコープではローカル変数のみで利用できる。  


```js
function test() {
  var num = 200;
  console.log('関数内:' + num);
// ローカル変数優先で参照
}

console.log('１回目の出力');
var num = 100;
test();
console.log('関数外:' + num);

// 出力結果
１回目の出力
関数内:200
関数外:100
```


### ブロックスコープ：let
- ブロック「{}中カッコ」内で「let」を使って宣言された変数、「const」を使って宣言された定数はローカルスコープを  
もつローカル変数になる。ブロック内でのみ利用可能なためブロックスコープと呼ぶ。  
- ES2015(ECMAScript 2015)リリース前まではローカルスコープは関数スコープのことを指していたがES2015  
リリースによりブロックスコープを利用できるようになった。
- 再代入できる。

```js
console.log('１回目の出力');
if (true) {
  var num1 = 100;
  console.log('ブロック内:' + num1);
}
console.log('ブロック外:' + num1);

console.log('２回目の出力');
if (true) {
  let num2 = 200;
	// let：ブロックスコープありの変数宣言
	// ブロック内で宣言することでブロックスコープをもつローカル変数になる
	// ブロック外で宣言するとグローバル変数になる。
	// 同名で再宣言できない
	// ブロックスコープとは{}を意味する

  console.log('ブロック内:' + num2);
}
console.log('ブロック外:' + num2);

//出力結果
１回目の出力
ブロック内:100
ブロック外:100
２回目の出力
ブロック内:200
Uncaught ReferenceError: num2 is not defined at 13
```

コンソールのエラー出力のパターン
1. 解析時エラー：jsを読み込む際に変数と関数は巻き上げが起こるが、その時点でエラー。
2. 実行時エラー：実行中の途中の行でエラー。コンソールにはエラー手前まで実行される。


### 定数：const
- 定数宣言。再代入によって後から値を変更することはできない。
- 判定用の値を入れておく場合などは定数を使用するとわかりやすいコードになる。
- 同じスコープ上に同名の変数を作成するとエラーになり処理が止まる。


```js
console.log('１回目の出力');

// constを使って定数の宣言
// 定数名はすべて大文字にするとよい（暗黙のルール）
const NUM = 100;
console.log(NUM);
NUM = 200;
console.log(NUM);

// 出力結果
１回目の出力
100
Uncaught TypeError: Assignment to constant variable. at constant.js:4
```

#### 未宣言変数
- 変数宣言時に「var」「let」「const」を使用せず変数名のみを記述した場合は未宣言変数として扱われる。
- 未宣言変数はどのスコープ上で記述してもすべてグローバルスコープとして扱われる。
- バグの原因になりやすいため、極力使用しない。

```js
function test() {
  num = 100;
  console.log('関数内:' + num);
}

console.log('１回目の出力');
test();
console.log('関数外:' + num);


//出力結果
１回目の出力
関数内:100
関数外:100
//関数内で宣言している変数も外から参照できてしまう
//グローバル変数になっている
//混乱の元となるため使用しないこと
```

## 午後は就職支援（企業説明会）
- [株式会社イマジカアロベイス](https://alobase.co.jp/)
- [株式会社クリーク・アンド・リバー社](https://www.cri.co.jp/)
- [株式会社リーディング・エッジ社](http://www.leadinge.co.jp/)
- [東京しごとセンター](https://www.tokyoshigoto.jp/)
- [株式会社セプト](https://www.septjp.co.jp/)  


[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
