---
layout: post
title:  "職業訓練校 | 2018.12.14 授業内容"
date: 2018-12-14 21:21:21
categories: job-training
---


# 2018.12.14 授業内容

## 耳より情報
繰り返しても違和感がない背景画像を提供しているサイト
 - [subtlepatterns](https://www.toptal.com/designers/subtlepatterns/)
 - [bg-patterns](http://bg-patterns.com/) こちらは画像サイズも選べる
 - googleでHTML5　サイトで検索するとトレンドのCSSサイトが出てくる


### 背景画像の定義
background-image: url(img/bg.gif);  
urlの前後に「''」を付けても付けなくてもよい。  
背景画像は背景色より上の層、背景画像が優先  

|値 |内容  |
|---|---|
|url(画像の場所)  |画像の場所を絶対パスか相対パスで指定  |


#### 背景画像の繰り返しを定義する
|値 |内容  |
|---|---|
|repeat（初期値）| 縦方向、横方向ともに繰り返し表示|
|repeat-x|	横方向（x軸方向）に繰り返し表示|
|repeat-y|	縦方向（y軸方向）に繰り返し表示|
|no-repeat|	繰り返し表示させず、1枚のみ表示|
デフォルトは左上から開始。開始位置の変更が以下。

#### 背景画像の表示位置を定義する
background-position: right top;

|値 |内容  |
|---|---|
|left|	左寄せで表示|
|right|	右寄せで表示|
|top|	上寄せで表示|
|bottom|	下寄せで表示|
|center|	中央寄せで表示|
|数値|	単位つきの数値(数値の場合マイナス値も指定可能)|
background-position: 10px(x軸,横) 20px(y軸,縦);

#### 背景画像の固定・移動を定義する
background-attachment: fixed; 定義しない、もしくは何も値を入れないとscrollが適用
|値 |内容  |
|---|---|
|scroll| スクロールと共に背景画像が移動、画面から消える|
|fixed|	背景画像が固定、スクロールしてもずっとついてくる|
背景のスタイルを一括定義する  
スペース区切りで一括してい可能  
body {  
/*  
background-color: #ccc;  
background-image: url(img/boxbg.gif);  
background-repeat: no-repeat;  
background-position: center top;  
background-attachment: fixed;  
*/  
background: #ccc url(img/boxbg.gif) no-repeat center top fixed;  
}  

- 位置は順不同
- ポジションの値はセットで定義すること
- 必要なものだけ半角スペースで定義、定義がないものはデフォルトの値となる

#### 背景画像のサイズを指定する
background-size
|値 |内容  |
|---|---|
|auto|自動的に算出される（初期値）|
|contain|縦横比は保持して、背景領域に収まる最大サイズになるように背景画像を拡大縮小する|
|cover|縦横比は保持して、背景領域を完全に覆う最小サイズになるように背景画像を拡大縮小する|

#### 背景画像の幅・高さを指定する
|値 |内容  |
|---|---|
|パーセンテージ|背景領域に対する背景画像の幅・高さのパーセンテージを指定する|
CSS3より導入で新しめ。TeraPadで大文字にならない。こういった場合、    
新しいCSSのプロパティがどのブラウザで使用できるか確認できるサイトで確認。    
  
background-sizeを一括に追加する場合は、ポジションの後ろにbackground-size  
```css
body{  
    background: #ccc url(img/boxbg.gif) no-repeat <font color="red">center top/20px 20px</font> fixed;  
}  
```
以下のように記載すると、background一括設定が勝ち、  
background-sizeの設定が無くても初期値が設定されてしまう。 
```css 
body{  
    <font color="red">background-size: 20px 20px;</font> → 一括設定の前に書いてしまうとNG  
    background: #ccc url(img/boxbg.gif) no-repeat center top fixed;  
}  
```
必ず一括設定の下に個別設定を記述すること。  
  
また以下のように背景画像を複数してした場合、右側に記述したほうが表示が下の層になる。  
サイズもカンマ区切りで指定した順に設定可能 
```css
background-image: url(img/boxbg.gif), url(img/yoda-03.png);  
background-size: 100px auto, 20px 20px;  
```
一括設定は以下。画像ごとに改行（したほうが見やすい）して「,」区切り。  
```css
background:   
    url(img/yoda-03.png) no-repeat,  
    #ccc url(img/boxbg.gif) repeat center top fixed;  
    background-size: 500px auto, 20px 20px;  
```

### ボックス構造

#### コンテンツ領域

テキストや画像などのコンテンツを表示領域  
width プロパティで幅、height プロパティで高さを指定  
  
#### パディング領域
枠線内側の余白（内余白）領域  
要素指定の背景色・画像が適用される  

#### ボーダー領域
枠線表示領域  
線の種類や、太さ、色を定義可能  

#### マージン領域
枠線外側の余白（外余白）領域  
親要素の背景を透過して表示  
 - コンテンツ領域の幅を定義する  
    - width: 600px;   
      ブロックレベル要素と置換インライン要素のみに適用可。  
      ※インライン要素には指定できない  

 - コンテンツ領域の高さを定義する
    - height: 600px;  
      ※インライン要素には指定できない  
      ※コンテンツ量が多いと重なるのでボタン等特殊な用途以外は基本的に指定しない  

### パディング領域（内余白）を定義する
padding: 20px 30px 40px;

|値 |内容  |
|---|---|
|数値l|	単位つきの数値（負の値は定義できない）|
1～4つの値指定可能（半角スペースで区切る）   
※「0」の時は単位を省略して記述可能 ボックスの値の指定方法  

値１つ：上下左右  
値２つ：上下、左右  
値３つ：上、左右、下  
値４つ：上、右、下、左(上から時計回り)  
paddingは一括指定。 個別指定はup,bottom,light,leftなど  
padding-left: 40px;   
padding-light: 30px;  

#### 枠線の種類（線種）を定義する
border-style: solid;
|値 |内容  |
|---|---|
|none（初期値）|	表示しない|
|solid|	1本線|
|double|	2本線|
|dashed|	破線|
|dotted|	点線|
|groove|	窪んだ線|
|ridge|	隆起した線|
|inset|	コンテンツ領域が窪んで見える線|
|outset|	コンテンツ領域が隆起して見える線|


#### 枠線の幅と色を定義する
border-width: 10px; 指定しないと「3px」

|値 |内容  |
|---|---|
|数値l|	単位つきの数値|

border-color: #FF0000; 指定しないと文字色
|値 |記述例 |
|---|---|
|カラーキーワード|	border-color: red;|
|色番号（16進数）|	border-color: #FF0000; border-color: #F00;|
|色番号（10進数）|	border-color: rgb(255,0,0);|
|色番号（割合）|	border-color: rgb(100%,0%,0%);|

##### ボーダー領域を一括定義する
border: solid 10px #F00;

|値 |値の例  |
|---|---|
|border-styleの値（必須）|	solid|
|border-widthの値|	10px|
|border-colorの値|	#F00|
border-styleプロパティは必須 指定する順番は自由 border-styleプロパティ以外の値は省略可  個別に値を指定するプロパティ  
left, right, top, bottom 
border-left: solid 10px blue;


##### 枠線を角丸にする
border-radius: 20px;

|値 |内容  |
|---|---|
単位付きの数値|	単位に応じた数値で余白を指定|
|パーセント|	親要素の横幅に対する割合|
1～4つの値指定可能  
値が1つ：四隅  
値が2つ：左上・右下と左下・右上  
値が3つ：左上と左下・右上と右下  
値が4つ：左上から時計回りにひとつづつ  
スラッシュで区切ると不規則な楕円にできる  
border-radius: 21px 122px 43px/80px 60px 40px 20px
border-radiusは「border」の中で一括指定できない。なのでborderの上の行に書いても反映されない  

### マージン領域（外余白）を定義する
margin: 20px 30px 40px;
完全に透明な余白

|値 |内容  |
|---|---|
|数値| 単位つきの数値|
|auto| 自動計算|

枠線外側の余白  
背景透明（親要素の背景色・背景画像が表示される余白）  
body要素はデフォルトで8pxの余白を持っている。  
  
個別に指定  
左指定 プロパティ名-left  
右指定 プロパティ名-right  
上指定 プロパティ名-top 
下指定 プロパティ名-bottom  

記述例 |  |   |
|---|---|---|
|padding-left  |border-left| margin-left |
|padding-right  |border-right| margin-right  |
|padding-top  |border-top  | margin-top|
|padding-bottom  |border-bottom  | margin-bottom|

 <font color="red"><strong>※上下方向のマージンは値の大きなほうが適用されます。上下の加算ではないことを注意。</strong></font>  
例）h2の下マージン30px、下にあるp要素の上マージン50px → h2とp要素の間のマージンは50pxとなる。  

左右マージンの「auto」（上下にautoは無し）  
右マージンにauto を指定した場合、親要素の横幅からマージン以外の横幅を引いた値が自動計算され適用  
要素自体を中央揃えにするには左右マージン共にautoを指定。  
widthの設定が大前提  
<font color="red"><strong>マージンの上下コンテンツ余白は値の大きい方</strong></font>  
<font color="red"><strong>paddingの上下コンテンツ余白は上下の値を足す</strong></font>  

[マージンの余白](img/margin_padding.jpg)

親領域にborderやpaddingが無い場合、子供の領域が親より多きれば親を突き抜ける。
親領域にborderやpaddingを設定すると、子供領域はその中に納まるが、親領域内でマージンが加算される→見た目親領域が大きくなる。

<h4>ボックスサイズの考え方</h4>
PCサイトの表示はだいたい幅960px
要素の幅はすべての要素を足した値となる。
ボックスの幅   = width + 左右padding + 左右border + 左右margin
ボックスの高さ = height + 上下padding + 上下border + 上下margin
デザインを考慮するうえで、widthとheightのプロパティ値だけではなく、ボックス全体の幅と高さであることを気を付けること。
widthはあくまでもコンテンツ領域の幅のみとなる。


ボックスサイズの算出方法を定義する
box-sixingプロパティ
widthやheightがどの領域の値を指すのか定義する。
CSS3で追加されたプロパティ
box-sixing: border-box

					<table border="1">
						<tr><th>値</th><th>内容</th></tr>
						<tr><td>content-box(初期値)</td><td>パディングとボーダーを含まない</td></tr>
						<tr><td>border-box</td><td>パディングとボーダーを含まない</td></tr>
					</table>


ペンダープレフィックス
仕様が固まっていない機能をchromeやファイアーフォックスは使えるようにしてしまうことがある。
そういった時に設定するプロパティ名
-moz-box-sixing: border-box → ファイアーフォックスだけに適用
-webkit-box-sixing: border-box → Chromeだけに適用
Can I useで確認できる。基本的に使わない方がよい。