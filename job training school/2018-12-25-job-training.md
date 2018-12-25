# 2018.12.20 授業内容

## 今日の有難いお言葉
よく使いそうな情報をまとめて取り出しやすくし、自分用の資料を作ろう。

## chromeの検証ツールについて
「iPhone5/SE」が一番幅が狭いので、こちらでスマホサイトの検証をするとよい。  
またCapture full size screenshotを使うと縦長いページもスクロールせずにショットを取ってくれる。  


### ハンバーガーメニュー
スマホ用の右上にある三本線のメニューアイコン

#### 授業で使用したハンバーガーメニューサンプル
一般的なのでコピペ使用で問題なし。変更が発生する場所だけ覚えておく。
■スマホナビHTML  

```html
<div class="nav sp">
  <div class="sp-nav">
    <ul>
      <li><a href="index.html">トップページ</a></li>
      <li><a href="nakano.html">中野区</a></li>
      <li><a href="shinjyuku.html">新宿区</a></li>
    </ul>
  </div><!-- .sp-nav -->
  <div class="navToggle">
    <span></span>
    <span></span>
    <span></span>
    <span>menu</span>
  </div>
</div><!-- .sp-nav -->
```

■スマホナビCSS  
```css
  /* スマホナビゲーション */ → 上から降りてくるメニュー一覧
  .sp-nav {
    position: fixed;
    z-index: 2;
    top: 0;
    left: 0;
    background-color: #581;
    text-align: center;
    transform: translateY(-100%); → 開始位置。-100%で自身と同じ分の高さを上にずらしている。メニューが追加されても大丈夫。
    transition: all 0.6s; → 降りてくるスピードを調整できる
    width: 100%;
  }
  .sp-nav ul {
    background: #8c4;
    padding-left: 0;
    list-style: none;
  }
  .sp-nav ul li {
    padding: 0;
    border-bottom: 1px dotted #581;
  }
  .sp-nav ul li:last-child {
    border-bottom: none;
  }
  .sp-nav ul li a {
    display: block;
    color: #fff;
    text-decoration: none;
    padding: 1em 0;
  }
  /* ハンバーガータップ時：メニュー表示 */
  .sp-nav.active {
    transform: translateY(0%);
  }

  /* ハンバーガー */ → 右上のメニュー
  .navToggle {
    display: block;
    position: fixed;
    right: 13px;
    top: 12px;
    width: 42px;
    height: 51px;
    cursor: pointer;
    z-index: 3;
    background-color: #581;
    text-align: center;
  }
  .navToggle span {
    display: block;
    position: absolute;
    width: 30px;
    border-bottom: solid 3px #eee;
    transition: .50s ease-in-out; → 棒が傾く速度
    left: 6px;
  }
  .navToggle span:nth-child(1) {
    top: 9px;
  }
  .navToggle span:nth-child(2) {
    top: 18px;
  }
  .navToggle span:nth-child(3) {
    top: 27px;
  }
  .navToggle span:nth-child(4) {
    top: 34px;
    border: none;
    color: #fff;
    font-size: 9px;
    font-weight: bold;
  }
  /* タップ後ハンバーガー */
  /* 最初のspanをマイナス45度に */
  .navToggle.active span:nth-child(1) { → 一番上の棒
    top: 18px;
    left: 6px;
    transform: rotate(-45deg); → 棒の傾く角度。675度などにすると回転してから納まる。
  }
  /* 2番目と3番目のspanを45度に */
  .navToggle.active span:nth-child(2),
  .navToggle.active span:nth-child(3) {
    top: 18px;
    transform: rotate(45deg);
  }
```

■スマホナビJS  
```js
◇HTML
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="script.js"></script>
◇JS：script.js
$(function() {
  $('.navToggle').click(function() {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.sp-nav').addClass('active');
    } else {
      $('.sp-nav').removeClass('active');
    }
  });
});
```


### transitionプロパティ
 transition効果（時間的変化）をまとめて指定する  
[★CSS3リファレンス](http://www.htmq.com/css3/transition.shtml)

### position補足
absoluteの親要素にstaticがなくfixedがある場合、fixedが親になる。  
そういった親子関係がある。  


### IEのスマホ対策について
IEは旧バージョンとの互換表示機能があるため、スマホ用サイトを作成してもうまく表示されないことがある。  
HTMLのheadタグにに以下のmetaタグを追加することにより、最新の方法で表示するよう指定できる。(互換表示させない)  

`````html
<meta http-equiv="X-UA-Compatible" content="IE=edge">
`````




<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
