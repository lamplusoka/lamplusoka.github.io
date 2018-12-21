# 2018.12.20 授業内容


### positionプロパティ
要素の配置方法
position:absolute;  
[CSSのpositionとは？]https://saruwakakun.com/html-css/basic/relative-absolute-fixed

■positionの値  
 - static：初期値はこれ。指定することはほとんどない
 - relative：現在の位置を基準に相対的な位置を決める
 - absolute：親要素を基準に絶対的な位置を決める
 - fixed：画面のきまった位置に固定する

### relative(基準枠指定)
「top」「bottom」「left」「right」「z-index」が使えるようになる。  
「top」「bottom」「left」「rightで今いる位置から表示位置を指定できる。  
表示位置を指定できる。  
★★基準枠指定でよく使う★★  
absolute指定の親（祖先）にあたる要素でのみ指定可能。  


### absolute(絶対配置)を指定すると  
「top」「bottom」「left」「right」「z-index」が使えるようになる。  
「top」「bottom」「left」「rightで基準枠から表示位置を指定できる。  

#### 基準枠について  
祖先に一番近いrelativeのついている要素が基準枠  
relativeのついている要素がない場合はbody要素が基準枠


### static(初期値)：通常位置  
「top」「bottom」「left」「right」プロパティが使えない（指定しても無視される）  


### fixed
body枠を基準に位置を指定し固定。親要素にrelativeがあっても関係ない。  
「top」「bottom」「left」「right」「z-index」プロパティが使えるようになる。  
スクロールしても常に同じ位置に固定化される。  
fixed枠の幅は中の要素によって可変する。画面幅いっぱいに表示させたい場合は以下。  
```css
width:100%
box-sizing: border-box;
margin: 0;
```
よくESサイトの「買い物かごへ」や「ページトップへ戻る」といった固定ボタンで使う。
```css
.shopping {
 background-color: #cddc39;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  margin: 0;
  box-sizing: border-box;
}
```

### z-indexプロパティ
z-index: 0;
前面・背面の位置調整ができる
■数値
数値が小さいほど背面  
数値が大きいほど前面    
position「relative」「absolute」「fixed」が指定されている時だけ機能する。  


## スマホサイトコーディング

[スマホサイト作成方法資料](docs/スマホサイト制作2018.pdf)  
以下の@media 以下の記述、(max-width: 480px)スクリーンが480px以下のになるとスマホ用CSSが適用される。
```css
/* スマホ用CSS */
@media screen and (max-width: 480px) {
  .pc {
    display: none;
  }
  .sp {
    display: block;
  }
  .wrapper {
    width: auto;
  }
  .main {
    float: none;
    width: auto;
  }
  .aside {
    float: none;
    width: auto;
  }
}


### よく画像へ使う設定。親要素の幅に合わせて画像を縮小、可変させる場合。
```css
/*親要素の幅を超える画像は縮小*/

img {
  max-width: 100%;
  height: auto;
}

```

検証ツールのスマホ画面確認用で、alt + shift + マウス上下で指のピンチイン、アウトができる。  


クロームの検証ツールでスマホ画面に横スクロールしなくてもsafariでスクロールできてしまうことがある。  


<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)