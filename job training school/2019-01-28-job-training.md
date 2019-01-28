# 2019.1.28 授業内容

## jQuery

### jQueryとは
- JavaScriptを簡単に扱うためのオープンソースライブラリ

[jQuery2018](docs/jQuery2018.pdf)  


#### jQueryを利用する
- 方法1:ダウンロードして利用
	- 自社サイト内にjQueryを置いて利用
		- ネットに接続していなくてもよい
		- ダウンロードして配置するのが面倒

- 方法2:大手サーバ(CDN)に接続して利用（通常はこちら）
	- 大手サーバ(CDN)のjQueryを使って利用
		- すぐ利用できる表示高速化がみこめる可能性がある
		- インターネット接続が必須になる大手サーバがダウンすると利用不可


[jQueryのサイト](https://code.jquery.com/)  
- uncompressed
	- 非圧縮で読みやすい。もし編集等する場合に使用。
- minified（通常はこちらを使おう）
	- 見づらい、変数なども短く省略している。軽いため通常はこちら。


### jQueryの呼び出し方、プログラミング
HTML内にて  
```html
<script>
$(function(){
【
ここにプログラムを記述】
});
</script>

jQuery(function)でも呼び出せる


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
//ページ読み込み完了後に関数内の処理を実行する

$(function(){
//functionは無名関数と呼ばれる

  console.log('jQuery読み込みOK！');
//ページ読み込み完了後に実行される処理

});
</script>


```
- jQuery読み込み完了後に記述する
- ページ読み込み完了後実行

#### 記述位置
- </body>直前記述が流行り
	- jQuery読込み時はHTMLの表示が止まる
	- ページを表示してからjQueryを読み込むことで表示高速化


#### jQueryの書き方：基本

`$('p').css('color','red');`

基本の書き方は２ステップ
1. 場所を選択する（CSSセレクタ） → $('p')
2. 処理を行う → .css('color','red');


```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>jQueryの書き方：基本</title>
</head>
<body>
<div id="header">
  <img src="pic1.jpg" alt="山" height="300">
  <h1>jQueryの書き方：基本</h1>
</div><!--header-->
<div class="column">
  <h2 class="title">jQueryの記述</h2>
  <p>処理対象の要素を選択し、どのような処理を行うかを記述する。<br>
  処理はjQueryで定義済みなので呼び出すだけでよい。</p>
</div><!--column-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- jQuery実行プログラムを記述 -->
<script>
$(function(){
  $('p').css('background-color','#fcc');
// $('p'):場所を選択CSSセレクタで場所選択：p要素
// css('background-color','#fcc')：処理
// 引数で指定した内容にデザインを変更
// 第1引数：CSSプロパティ名を文字列で指定
// 第2引数：CSSの値

  //■練習１  <h1>の文字色をredに設定してみる
  $('h1').css('color', 'red');

  //■練習２  <h2>の背景色を#ccfに設定してみる
  $('h2').css('background-color', '#ccf');

  //■実践  id名「header」に枠線(実線、2px、#ccc)を設定してみる
  $('#header').css('border', 'solid 2px #ccc');

// jQueryを使用しない書き方
// document.getElementById('header').style.border・・・長ったらしい

  //■実践  class名「column」に枠線(二重線、5px、#000)を設定してみる
  $('.column').css('border', 'double 5px #000');

});
</script>
</body>
</html>
```


#### jQueryの書き方：イベント

```html
$('p'). on('click', function(){
// p
がクリックされた時の処理
});
```

イベント駆動プログラミング
1. 場所を選択 → $('p')
2. 処理開始のタイミング（イベント）を指定 → on('click' →「click」がイベント内容
3. 処理内容 → function(){


#### イベントの種類
- dblclick:ダブルクリック時
- mouseup:マウスボタンを離した時
- mouseover:マウスカーソルが要素内に入った時
- mouseout:マウスカーソルが要素内から出た時
- mousemove:要素内でマウスカーソルが移動した時
- keyup:キーを離した時
- scroll:スクロールした時
- load:読込が完了した時

[ jQueryイベント一覧：たねっぱ](http://taneppa.net/jquery-event-list/)  

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>：jQueryを試してみる</title>
</head>
<body>
<p class="event1">イベント１</p>
<p class="box1">ボックス１</p>
<p class="event2">イベント２</p>
<p class="box2">ボックス２</p>
<p class="event3">イベント３</p>
<p class="box3">ボックス３</p>
<p class="event4">イベント４</p>
<p class="box4">ボックス４</p>
<p class="event5">イベント５</p>
<p class="box5">ボックス５</p>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(function(){
  $('.event1').on('click',function(){
    $('.box1').css('color','red');
  });
  // 場所：class「event1」
  // イベントの種類：onメソッドで
  //  onメソッドの第1引数：イベント指定「click」
  // 処理
  //  onメソッド第2引数：無名関数で指定
  //      class「box1」の「文字色」を「赤」に変更


  //■練習１  クラス名「event2」をクリックしたときに
  //          クラス名「box2」の文字色を青にしてみる
  $('.event2').on('click', function(){
    $('.box2').css('color', 'blue');
  })

  //■練習２  クラス名「event3」をダブルクリックしたときに
  //          クラス名「box3」の背景色を#fccに設定してみる
  $('.event3').on('dblclick', function(){
    $('.box3').css('background-color', '#fcc');
  })


  //■実践  「event4」以降を自由に設定してみる
  $('.event4').on('mouseover', function(){
    $('.box4').css('border', 'solid 10px red');
  })
  $('.event5').on('mouseup', function(e){
    if(e.which == 1) {
      $('.box5').css('color', 'red');
    }else if(e.which == 2) {
      $('.box5').css('color', 'green');
    }else if(e.which == 3) {
      $('.box5').css('color', 'pink');
    }

  })

});
</script>
</body>
</html>
```




#### アニメーション処理

```html
$('#btn1'). on('click', function(){
$('#box1').hide();
});
```
#btn1 id名box1をクリックしたら指定処理$('#box1').hide();を実行  

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>：jQueryを試してみる</title>
<style>
.box1,.box2,.box3,.box4,.box5,.box6,.box7,.box8,.box9,.box10 {
  width: 200px;
  height: 200px;
  background-color: #fcc;
}
</style>
</head>
<body>
<p class="event1-1">イベント1-1：クリックでボックス１を非表示する</p>
<p class="event1-2">イベント1-2：クリックでボックス１を表示する</p>
<p class="box1">ボックス1</p>

<p class="event2-1">イベント2-1：ダブルクリックでボックス２を非表示する</p>
<p class="event2-2">イベント2-2：ダブルクリックでボックス２を表示する</p>
<p class="box2">ボックス2</p>

<p class="event3">イベント3：クリックする度にボックス３を表示・非表示</p>
<p class="box3">ボックス3</p>

<p class="event4-1">イベント4-1：クリックする度にボックス４をスライドアップ</p>
<p class="event4-2">イベント4-2：クリックする度にボックス４をスライドダウン</p>
<p class="box4">ボックス4</p>

<p class="event5">イベント5：クリックする度にボックス５をスライドトグル</p>
<p class="box5">ボックス5</p>

<p class="event6-1">イベント6-1：クリックする度にボックス６をフェイドアウト</p>
<p class="event6-2">イベント6-2：クリックする度にボックス６をフェイドイン</p>
<p class="box6">ボックス6</p>

<p class="event7">イベント7：クリックする度にボックス７をフェイドトグル</p>
<p class="box7">ボックス7</p>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(function(){
  $('.event1-1').on('click',function(){
    $('.box1').hide(2000);
  });

  //■練習１  クラス名「event1-2」をクリックしたときに
  //          クラス名「box1」を表示にする
  $('.event1-2').on('click', function(){
    $('.box1').show(1000);
  })


  //■練習２  クラス名「event2-1」をダブルクリックしたときに
  //          クラス名「box2」を非表示する
  $('.event2-1').on('dblclick', function(){
    $('.box2').hide(1000);
    // hideメソッド：引数なしで即座に非表示 → hide();
  })
  //場所：クラス名「event2-1」
  //イベントの種類：ダブルクリック
  //処理：クラス名「box2」を非表示にする


  //■練習３  クラス名「event2-2」をダブルクリックしたときに
  //          クラス名「box2」を表示する
  $('.event2-2').on('dblclick', function(){
    $('.box2').show(500);
  })


  //■練習４  クラス名「event3」をクリックするごとに
  //          クラス名「box3」の表示・非表示を切り替える
  $('.event3').on('click', function(){
    $('.box3').toggle(500);
  })


  //■練習５  クラス名「event4-1」と「box4」を使って
  //          slideUp()を試してみる
  $('.event4-1').on('click', function(){
    $('.box4').slideUp(1000);
  })


  //■練習６  クラス名「event4-2」と「box4」を使って
  //          slideDown()を試してみる
  $('.event4-2').on('click', function(){
    $('.box4').slideDown(200);
  })


  //■練習７  クラス名「event5」と「box5」を使って
  //          slideToggle()を試してみる
  $('.event5').on('dblclick', function(){
    $('.box5').slideToggle(1000);
  })


  //■練習８  クラス名「event6-1」と「box6」を使って
  //          fadeOut()を試してみる
  $('.event6-1').on('click', function(){
    $('.box6').fadeOut(1000);
  })


  //■練習９  クラス名「event6-2」と「box6」を使って
  //          fadeIn()を試してみる
  $('.event6-2').on('click', function(){
    $('.box6').fadeIn(4000);
  })


  //■練習１０  クラス名「event7」と「box7」を使って
  //          fadeToggle()を試してみる
  $('.event7').on('click', function(){
    $('.box7').fadeToggle(2000);
  })


});
</script>
</body>
</html>
```


#### 要素操作

- $('#box1').html(['コンテンツ']);
	- 処理の名前(.html)：html対象要素内のコンテンツを取得引数に値を入れた場合は書き換え
	- 処理に応じた細かい指示(['コンテンツ'])：’コンテンツ(タグ含む)’（省略可）要素内のコンテンツを指定した値に上書き省略時は取得

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>：jQueryを試してみる</title>
<style>
#frame1,
#frame2 {
  border: solid 1px #777;
  margin: 10px;
}
</style>
</head>
<body>
<p class="event1">イベント１</p>
<p class="box1">ボックス１</p>

<p class="event2">イベント２</p>
<p class="box2">ボックス２</p>

<p class="event3">イベント３</p>
<p class="box3">ボックス３</p>

<p class="event4">イベント４</p>
<p class="box4">ボックス４</p>

<div id="frame1">
  <p class="event5">イベント５</p>
  <p class="box5">ボックス５</p>

  <p class="event6">イベント６</p>
  <p class="box6">ボックス６</p>

  <p class="event7">イベント７</p>
  <p class="box7">ボックス７</p>
</div>

<div id="frame2">
  <p class="event5">イベント５</p>
  <p class="box5">ボックス５</p>

  <p class="event6">イベント６</p>
  <p class="box6">ボックス６</p>

  <p class="event7">イベント７</p>
  <p class="box7">ボックス７</p>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>

$(function(){
  $('.event1').on('click',function(){
    $('.box1').html('イベント1をクリックしました！');
    // JavaScriptで書くと
      // document.getElementById('ID名').innerHTML = 'イベント1をクリックしました！'

    //引数ありhtmlメソッド
    //対象要素の内容を引数の内容に変更する

  });
  // 場所：$('.event1')「クラス名event1」
  // イベントの種類：click
  // 処理：$('.box1').html('イベント1をクリックしました！')
  //  場所：$('.box1')「クラス名box1」
  //  処理：htmlメソッド（引数あり）「要素内引数で変更する」

  $('.event2').on('click',function(){
    var str = $('.box1').html();//ゲッターで取得
    $('.box2').html(str);//セッターで変更
  });
  // 場所：$('.event2')「クラス名event2」
  // イベントの種類：click
  // 処理：$('.box1').html('イベント1をクリックしました！')
  // var str = $('.box1').html();
  // $('.box1').html()：htmlメソッド（引数なし）「対象要素内のコンテンツを取得」
  // 「クラス名box1」の内容を変数strに代入



  //■練習１  クラス名「event3」をダブルクリックしたときに
  //          クラス名「box3」の内容を『イベント3をダブルクリックしました！』
  //          に書き換える
  $('.event3').on('dblclick', function(){
    $('.box3').html('イベント3をダブルクリックしました！');
  });

  //■練習２  クラス名「event4」にカーソルが入ったときに
  //          クラス名「box4」の内容を『イベント4を通過中』
  //          に書き換える
  $('.event4').on('mouseover', function(){
    $('.box4').html('イベント4を通過中');
  })
  //■練習３  クラス名「event4」からカーソルが出たときに
  //          クラス名「box4」の内容を元の内容
  //          に書き換える
  $('.event4').on('mouseout', function(){
    $('.box4').html(str);
  })

});
  var str = $('.box4').html();
  console.log(str);

</script>
</body>
</html>
```

- $('#box1').prepend('コンテンツ');
	- 処理の名前：prepend対象要素内の先頭にコンテンツを追加
	- 処理に応じた細かい指示：’コンテンツ(タグ含む)’要素内の先頭に指定した値を追加する



[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
