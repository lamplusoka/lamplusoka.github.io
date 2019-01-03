# 2018.12.11 授業内容

## 本日の有難いお言葉
訓練中は何度もトライして何度失敗しても問題ない期間。どんどんトライしてください。  

### リスト
二つのタグを使用  
ulタグのすぐ下にはliタグを置くこと。セットで使用。  
ulが親、liが子、親子要素と呼ばれる。
例）ulの子供要素はli    
楽天やゾゾタウンの左のカテゴリ、パンくずリストなどに使われている。リストはよく使う。  

#### 番号なしリストの定義
ul要素 unordered list：番号なしリスト  
li要素 list item：リスト項目  
 - 左に余白ができる
 - 項目先頭にマーカー「・」が表示される
```html
<ul> → ul要素が枠を担当
<li>Windows&</li> → li要素が項目を担当
<li>Macintosh</li> → li要素が項目を担当
<li>Linux</li> → li要素が項目を担当
</ul>
```

↓

Windows  
Macintosh  
Linux  

要素の追加が可能だが、文法注意  
 - 正しいソースコード
```html
<ul>
<li>Windows</li>
<li><strong>Macintosh</strong></li>
<li>Linux</li>
</ul>
```
 - 間違ったソースコード

```html
<ul>
<li>Windows</li>
<strong><li>Macintosh</li></strong>
<li>Linux</li>
</ul>
```
 - ul要素とli要素はセットで使う
 - 項目内のみ他のタグを使用可
 - li要素外に他のタグ使用はNG

### パンくずリスト
ヘンデルとグレーテルのパンくずをちぎって帰り道の印として使ったことからの由来   
Chrome F12キーでデベロッパーツールが開く  

#### 番号付きリストの定義  
ol要素 ordered list：番号付きリスト  
li要素 list item：リスト項目  

```html
<ol> → ul要素が枠を担当
<li>Windows</li> → li要素が項目を担当
<li>Macintosh</li> → li要素が項目を担当
<li>Linux</li> → li要素が項目を担当
</ol>
```
↓
 - Windows  
 - Macintosh  
 - Linux  

#### 番号付きリストの属性
通常開始番号は「1」  
start属性で開始番号変更可能  
※HTML4.01では非推奨  
※HTML5で非推奨解除  
```html
<ol start="5">
<li>Windows&</li>
<li>Macintosh</li>
<li>Linux</li>
</ol>
```
↓

1. Windows  
2. Macintosh  
3. Linux  
連番を変更  
value属性で連番変更可能  
```html
<ol >
<li>Windows&</li>
<li value="5">Macintosh</li>
<li>Linux</li>
</ol>
```
↓ 
1. Windows
5. Macintosh
6. Linux

#### 定義リストの定義
dl要素 unordered list：定義リスト  
dt要素 definition term：定義項目名  
dd要素 definition description：定義項目の説明  
三つでセット  
```html
<dl> → dl要素が枠を担当
<dt>１日目</dt> → dt要素が項目タイトルを担当
<dd>18時から東京公演</dd> → dd要素が項目説明を担当
<dt>２日目</dt> → dt要素が項目タイトルを担当
<dd>20時から大阪公演</dd> → dd要素が項目説明を担当
</dl>
```

↓   

１日目  
　　18時から東京公演  
２日目  
　　20時から大阪公演  
dl,dt,ddタグでは、リスト一つに対し子供タグが2つなるため一つにくくれない。  
後々CSSでデザインするときにul,liのほうが一つのリストに対して管理できるので編集しやす。  
dt,ddタグ内に孫タグを入れると怒られる。  

#### テーブルの定義
table要素 table：表組、大枠  
tr要素 table row：行  
th要素 table header cell：見出しセル、太字  
td要素 table data cell：通常セル、左揃え  
```html
<table>
<tr><th>製品名</th><th>価格</th></tr>
<tr><td>HDD 1TB</td><td>8,000円</td></tr>
<tr><td>SSD 512GB</td><td>20,000円</td></tr>
</table>
```
↓  

|製品名|価格|
|--|--|
|HDD 1TB|	8,000円|
|SSD 512GB|	20,000円|

##### テーブルの行や列連結属性
- colspan属性：列をまとめる  
    - 列を連結する属性
    - th要素もしくはtd要素にを記述
    - まとめる列数を数値で指定

- rowspan属性：行をまとめる
    - 行を連結する属性
    - th要素もしくはtd要素にを記述
    - まとめる行数を数値で指定

```html
<table border="1">
<tr><th>セル1</th><th>セル2</th><th>セル3</th><th>セル4</th></tr>
<tr><th>セル5</th><td>セル6</td><td>セル7</td><td>セル8</td></tr>
<tr><th>セル9</th><td>セル10</td><td>セル11</td><td>セル12</td></tr>
<tr><th>セル13</th><td>セル14</td><td>セル15</td><td>セル16</td></tr>
</table>
```

<table border="1">
<tr><th>セル1</th><th>セル2</th><th>セル3</th><th>セル4</th></tr>
<tr><th>セル5</th><td>セル6</td><td>セル7</td><td>セル8</td></tr>
<tr><th>セル9</th><td>セル10</td><td>セル11</td><td>セル12</td></tr>
<tr><th>セル13</th><td>セル14</td><td>セル15</td><td>セル16</td></tr>
</table>

↓結合

```html
<table border="1">
<tr><th>セル1</th><th colspan="3">セル2</th></tr>
<tr><th rowspan="3">セル5</th><td>セル6</td><td>セル7</td><td>セル8</td></tr>
<tr><td>セル10</td><td>セル11</td><td>セル12</td></tr>
<tr><td>セル14</td><td>セル15</td><td>セル16</td></tr>
</table>
```

<table border="1">
<tr><th>セル1</th><th colspan="3">セル2</th></tr>
<tr><th rowspan="3">セル5</th><td>セル6</td><td>セル7</td><td>セル8</td></tr>
<tr><td>セル10</td><td>セル11</td><td>セル12</td></tr>
<tr><td>セル14</td><td>セル15</td><td>セル16</td></tr>
</table>

### リンクの定義
a要素  
anchor：錨  

文字色  
未訪問時：青  
訪問済時：紫  
下線が表示される  
`<p>テキスト<a href=“ファイルの場所">リンクの対象</a>テキスト</p>`
↓  
<p>テキスト<a href=“ファイルの場所">リンクの対象</a>テキスト</p>

href属性：Hypertext REFerence（参照先）  
- リンク先ファイルの場所をパスで指定  

target属性：リンク先を表示する対象  
- 「_blank」指定で別タブで表示  

`<a href="http://www.inutic.com/" target="_blank">inutic records<a>`
<a href="http://www.inutic.com/" target="_blank">inutic records</a>

#### 絶対パス
誰から見ても変わらない住所
東京都杉並区東中野...のように、北海道にいる人が聞いても沖縄にいる人が聞いてもわかる書き方。
`http://から始まるアドレス(URL)`を使ってファイルの場所を指定
例） http://jobtech.jp/html_css/index.html  

##### プロトコル(httpの部分)  
http - HyperText Transfer Protocol の頭文字  
HTMLをやりとりする通信規約の意味  
  
サーバ名  
jobtech.jp - サーバの名前  
  
パス名  
html_css/index.html - サーバ内のファイルの場所 パス内の「/（スラッシュ）」はフォルダを意味する
主に外部サイトへのリンクに使用  
広い地域から狭い地域へと対象を絞ってファイルを指定  

#### 相対パス
自分から見た相手の住所  
北海道から見た東京は南、沖縄から見た東京は北のように自分の今いる場所を起点に考える  
../img/photo.jpg  
- / フォルダの意味
- ./ 自分のいる階層
- ../ 1つ上の階層
- ../../ 2つ上の階層

課題  
自己紹介文を考えておこう。  
後で作成予定。好きなものを三つ挙げること。  