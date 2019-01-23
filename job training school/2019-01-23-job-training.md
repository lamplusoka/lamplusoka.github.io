# 2019.1.23 授業内容

## Javascriptの続き

||オブジェクト外 名前|オブジェクト内 オブジェクト名．名前|
|-|-|-|
|値|変数|プロパティ|
|処理|関数|メソッド|

オブジェクト名はPascal記法  
Pascal記法：すべての単語の頭文字が大文字 例）UserName  


### Arrayオブジェクト
Arrayインスタンスの作成
```js
new Array('イチゴ',...) → あまり使わない
```
作り方の説明  
new → で新しいものを作る  
Array → Arrayオブジェクトを利用する  
new オブジェクト名()：コンストラクタと呼ぶ  
オブジェクトのコピーを新しく製造する処理  
オブジェクトのコピーのことを「インスタンス」と呼ぶ  

Mathオブジェクトはnewをつかってインスタンス（コピー）を作成せずに使用できる。  
原本（ひな形）を直接利用する。そのためMathは特殊なオブジェクトとなる。  
同様な特殊オブジェクトいくつかあるが少数。  

インスタンス内のメソッドはインスタンスメソッド。  
Mathのように特殊なオブジェクトのメソッドはスタティックメソッド（静的メソッド）と呼ぶ。  

#### インスタンスメソッドと静的メソッドの見分け方
- 静的メソッドはメソッド名の頭文字が大文字。
- インスタンスメソッドは自身でネーミングするため、頭文字が小文字となる。


- JavaScriptのリファレンスサイト
	- https://developer.mozilla.org/ja/docs/Web/JavaScript/Reference/Global_Objects/Array/prototype

- Array.prototype
	- prototypeはコピーされたインスタンスないで使うよ、との意味


### Stringオブジェクト
文字列にもオブジェクトが存在する。

#### オートボクシング・アンボクシング
-オートボクシング
	- 文字列はプロパティやメソッドを利用しようとした時、自動的にStringインスタンスに変換される。  
		これをオートボクシングと呼ぶ。  

- アンボクシング
	- プロパティやメソッドの利用が終わると自動的にStringインスタンスが破棄されて文字列に戻る。  
		これをアンボクシングと呼ぶ。

- 他の例
	- console.log('答えは' + (4 + 2))
	- この4 + 2 は数値型だが、文字列と足す場合、裏では数値型オブジェクトが値を文字列型へ変換している。

■リテラル  
- 配列リテラル→[]を書く
- 文字列リテラル→''or""を書く
- 数値リテラル→数字を書く
書く決まりと考えればよい。  

### Dateオブジェクト

1970/1/1 0時0分0秒の基準時間を持っている。

new Date()  
new 頭文字大文字で名前の後ろに()がある → コンストラクタ  
⇒ Dateオブジェクトのコピー（インスタンス）を作成するコンストラクタ  

#### Dateインスタンスの作成
日時の処理をまとめたのがDateオブジェクト

- 引数なし：インスタンス生成時の日時を設定（JavaScriptを実行した時間）
	- new Date()

- 引数1つ：文字列で任意の日時を設定
	- こちらを実行するとその日時を管理するDateオブジェクトのコピー（インスタス）を作成する。
	- new Date('年/月/日 時:分:秒')
	- new Date('年/月/日')

- 引数必須2つ（最大7つ）
	- new Date(year, month[, day, hour, min, sec ,ms])
		- month は経過月：1月は「0」～12月「11」なので注意
		- 数値で渡すときは1か月ずれるので注意


```js
console.log('１回目の出力');
var today = new Date();
console.log(today);
var date1 = new Date('2018/1/1 12:00');
console.log(date1);
var date2 = new Date(2018, 0, 1, 12, 0);
// Date(数値,数値,数値,数値,数値,)
         年   月   日   時   分

console.log(date2);

var date3 = new Date(1514775600000);
//1970/1/10：00：00 から何ミリ秒経過したかを計算する処理。

console.log(date3);


console.log('２回目の出力');

// ゲッターメソッド
console.log(date1.getFullYear());
// getFullYear():インスタンスが持っている日時情報から「年」（西暦4桁）を取得する。

console.log(date1.getMonth());
// getMonth():インスタンスが持っている日時情報から「月」(0-11)を取得する。

console.log(date1.getDate());
// getDate():インスタンスが持っている日時情報から「日」(1-31)を取得する。

console.log(date1.getDay());
// getDate():インスタンスが持っている日時情報から「曜日」(0-6)を取得する。0:日 ～ 6：土曜

console.log(date1.getTime());
getTime():インスタンスが持っている日時情報（1970/1/1 00:00:00）からミリ単位の数値を返す。

console.log('３回目の出力');
// セッターメソッド
// インスタンスが管理している情報の必要な箇所を設定する際に使用する。
console.log(date1.setFullYear(2000));
console.log(date1);

console.log('４回目の出力');
console.log(date1.toString());
console.log(date1.toLocaleString());


■結果

１回目の出力
Wed Jan 23 2019 12:53:43 GMT+0900 (日本標準時)
Mon Jan 01 2018 12:00:00 GMT+0900 (日本標準時)
Mon Jan 01 2018 12:00:00 GMT+0900 (日本標準時)
Mon Jan 01 2018 12:00:00 GMT+0900 (日本標準時)
２回目の出力
2018
0
1
1
1514775600000
３回目の出力
946695600000
Sat Jan 01 2000 12:00:00 GMT+0900 (日本標準時)
４回目の出力
Sat Jan 01 2000 12:00:00 GMT+0900 (日本標準時)
2000/1/1 12:00:00

```


#### 日付を進める

```js
console.log('１回目の出力');
var date1 = new Date(2018, 6, 15);
// 2018/7/15 のデータを管理

console.log(date1.toLocaleDateString());
date1.setMonth(date1.getMonth() + 1);
// スタックとキュー
// 後から入ってきたものを先に処理する。上記では date1.getMonth() + 1 が先に処理されてから date1.setMonth を処理する。
// これは後入れ先出し。
// 先れ先出しもある


console.log(date1.toLocaleDateString());
date1.setDate(date1.getDate() - 1);
console.log(date1.toLocaleDateString());

console.log('２回目の出力');
// 今月の最終日を取得

var date2 = new Date();
// 今日の日付を管理

// var date2 = new Date('2018/8/20');
console.log(date2.toLocaleDateString());
date2.setMonth(date2.getMonth() + 1);
// 来月の今日 2/23

// このままではバグがある。1/30の一か月後の2/30は無いため3/2に設定される。
// 2月の末尾取得になってしまうので
// 「日」の値を28日以前に固定する
date2.seteDate(5) → 5日に設定

console.log(date2.toLocaleDateString());
date2.setDate(0);
// 来月の0日に設定 → つまり一日の前日
// つまり今月の最終日を取得可。

console.log(date2.getDate(5));



console.log('３回目の出力');
var code = (date2.getMonth()+1) + '月から選択：';
code += '<select name="date">\n';
for (var i = 1; i <= date2.getDate(); i++) {
  code += '<option value="'+i+'">'+i+'日</option>\n';
}
code += '</select>\n';

console.log(code);
document.getElementById('display1').innerHTML = code;
```




[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
