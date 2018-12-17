# 2018.12.17 授業内容



## 耳より情報

[WinMarge](http://www.geocities.co.jp/SiliconValley-SanJose/8165/winmerge.html)
変更前と変更後のファイルの差異を色分けで表示してくれるアプリ  

  
## リストのスタイルの定義
  

### 文字サイズを定義する
tableとtable要素の文字サイズを20px、td要素は30px  

```css

table{
	font-size: 20px;

}
td{
	font-size: 30px;
}
```
  
### 背景色を定義する
background-color:  
```css
td{
	font-size: 30px;
	background-color: #CCF;
}
```
  
### 背景画像を定義する
background-image:url(パス)  
画像の場所を絶対パスか相対パスで指定  
```css
td{
	font-size: 30px;
	background-color: #CCF;
	background-image: url(img/tdbg.gif);

}
```
  
### 枠線を定義する
border: solid 5px navy;  
上記は一括設定。個別は以下  

|値| 値の例|
|--|--|
|border-styleの値（必須）| solid|
|border-widthの値| 10px|
|border-colorの値| #F00|
  
  
### 枠線の隙間をなくす
border-collapse: collapse;  

|値| 記述例|
|--|--|
|collapse| 隣接する枠線を重ねて表示|
|separate| 隣接する枠線の間隔をあけて表示|

枠線の色は統一したほうが見やすい。  
  

### セルの余白を定義する
padding : 10px 20px;  
  

### 幅を定義する
width: 60px  
定義しない場合、中の文字数によって幅が変わる。widthを使うと固定する。  
※半角英数が区切りなく入力されている場合、widthが広がる。スペースがあれば幅固定、改行される。  

|値| 内容|
|--|--|
|auto（初期値）| 親要素の横幅いっぱいに広がる|
|数値| 単位つきの数値|
|割合| 親要素の横幅に対する割合|
  
  
### 高さを定義する  
height: 400px;
セル内の文字数が多いと、heightは無視されて文字が改行されて表示される  
  
  
### セル内の行揃えを定義する
text-align: left;  
center、left、light  
セル内の文章を左揃え、右揃え、中央揃えにする。  


### セル内の縦方向揃え位置を定義する
vertical-align: top;  

vertical-alignプロパティの代表的な値  

|値| 内容|
|--|--|
|baseline|親要素のベースラインに揃える|
|top|上揃え|
|middle|中央揃え|
|bottom|下揃え|

<font color="red">※ブロックレベルには適用不可。</font>  
こちらのプロパティはインライン要素のみに適用可。  
vertical-alignの主な使いどころは、テーブル要素、ボックスパーツの横の文字（名前：入力ボックス）。  

そして画像の下に謎の隙間が空いている状態→インライン要素はそもそも下からbottom,baseline,topという線引きがある。  
デフォルトはbaselineからとなり、画像が下の領域線から少し浮く。この場合vertical-align:bottomを指定すると解決。  
-----top----


----baseline---  
----bottom---

ブロックレベル要素にはvertical-alignは使用できない。邪道だがline-heightを使える。一行限定。二行でレイアウト変わる。  
二行で使うならdisplay:flex;、align-items: center,を使うとできる  。


■ブロックレベル内で縦方向中央揃えにしたい
※vertical-alignはブロックレベルでは無効！！

・１行限定：heightとline-heightの値を同じにする
height: XXpx;
line-height: XXpx;

・複数行になる可能性がある
display: flex;
align-items: center;


### テキストの折り返しを禁止する  
white-space: nowrap;  

■値
 - normal
	- ソース中のホワイトスペースを無視
	- ソース中の改行を1つの半角スペースとして表示
	- ボックスサイズが指定されている場合にはそれに合わせて自動改行する（初期値）
 - pre
	- ソース中のホワイトスペースをそのまま表示
	- ソース中の改行をそのまま表示
	- ボックスサイズが指定されている場合にも自動改行しない
 - nowrap
	- ソース中のホワイトスペースを無視
	- ソース中の改行を1つの半角スペースとして表示
	- ボックスサイズが指定されている場合にも自動改行しない
 - pre-wrap
	- ソース中のホワイトスペースをそのまま表示
	- ソース中の改行をそのまま表示
	- ボックスサイズが指定されている場合にはそれに合わせて自動改行する
 - pre-line
	- ソース中のホワイトスペースを無視
	- ソース中の改行をそのまま表示
	- ボックスサイズが指定されている場合にはそれに合わせて自動改行する


### テーブル（表）の表示方法を指定する
table-layout: fixed;

table-layoutプロパティは、テーブル（表）の表示方法を指定する際に使用します。  
指定できるのは、テーブル（表）の列幅を自動レイアウトにするか（auto）、固定レイアウトにするか（fixed）についてです。いずれの場合も行の高さは自動的に算出されます。  
初期値のtable-layout:auto; では、ブラウザはテーブル（表）全体を読み込んでから、セル内容に合わせて各列の幅を決定して表示を開始しますが、 table-layout:fixed; を指定すると、  
最初の一行目を読み込んだ時点で各列の幅を固定して表示を開始するため、 表示が速くなるメリットがあります。  
table-layoutプロパティに「fixed」を指定する場合には、必要に応じて各列（セル）の幅を指定しますが、幅が指定されていない列には残りの幅が均等に割り当てられます。  

■値
 - auto
	- テーブル（表）の列幅を自動レイアウトにする（初期値）
 - fixed
	- テーブル（表）の列幅を固定レイアウトにする


## リストのスタイルを定義する


### マーカーを定義する

list-style-type: none;

ul要素の値
ol要素の値もulで使える

|値| 内容|
|--|--|
|disc| 黒丸：●|
|circl|e 白丸：○|
|square| 四角：■|
|none |表示しない|


ol要素の値

|値| 内容|
|--|--|
|decima|l アラビア数字：１、２、３|
|lower-alpha| 小文字アルファベット：a、b、c|
|upper-alpha| 大文字アルファベット：A、B、C|
|lower-roman| 小文字ローマ数字：i、ii、iii|
|upper-roman| 大文字ローマ数字：I、II、III|
|none| 表示しない|

よく使うのが「none」



### マーカー画像を定義する
list-style-image: url(img/mark.gif);

|値| 内容|
|--|--|
|url(画像の場所)| 画像の場所を絶対パスか相対パスで指定|

list-style-typeとlist-style-imageを同時に指定した場合は、list-style-imageが優先  

使い勝手が悪いため、あまり使用しない。noneで消して背景画像を利用する。


### マーカー位置を定義する
list-style-psition: inside;

|値| 内容|
|--|--|
|outside|マーカーを外側に定義する|
|inside|マーカーを内側を定義する|

### マーカーを一括定義する
```css
list-style: circle url(img/ul_marker.gif) inside;


```

### リストのインデントを定義する
padding-left: 0;

ul要素やol要素はブラウザがもつデフォルトCSSによって、左内余白40pxが定義されています。
この値を変更するにはpadding-left：px を利用します。


### 背景画像でマーカーを表示する方法

```css
li{
	list-style-type: none; デフォルトのマーカーを消す
	background-image: url(img/ul_marker1.gif);  画像を指定する
	background-repeat: no-repeat;  画像を繰り返さない
	background-position: 0 1px;  画像の上下左右位置をずらす
	padding-left: 15px;  

}
```



### 影を作成するプロパティ
box-shadow: 0 5px 0 #ddeeee

|値| 内容|
|--|--|
|1つ目|：横方向への移動値|
|2つ目|：縦方向への移動値|
|3つ目|：ぼかし（省略可）|
|4つ目|：広がり（省略可）|
|5つ目|：色（省略可）|
|6つ目|：影の位置（省略可）：外側（省略時） 内側inset|


