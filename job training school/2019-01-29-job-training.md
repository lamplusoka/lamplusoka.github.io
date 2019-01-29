# 2019.1.29 授業内容

## jQuery 続き

#### 要素操作の続き

- $('#box1').prepend('コンテンツ');
	- 処理の名前：prepend対象要素内の先頭にコンテンツを追加
	- 処理に応じた細かい指示：’コンテンツ(タグ含む)’要素内の先頭に指定した値を追加する

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>：jQueryを試してみる</title>
<style>
#frame1,
#frame2,
#frame3 {
  border: solid 1px #777;
  margin: 10px;
}
.box1,
.box2,
.box3,
.box4,
.box5,
.box6,
.box7,
.box8,
.box9,
.box10 {
  width: 200px;
  height: 200px;
  background-color: #fcc;
}
span {
  color:red;
  font-weight: bold;
}
</style>
</head>
<body>
<div id="frame1">
  <p class="event1">イベント１：クリックでボックス１の先頭に追加</p>
  <p class="box1">ボックス１</p>
  <p class="event2">イベント２：クリックでボックス２の末尾に追加</p>
  <p class="box2">ボックス２</p>
  <p class="event3">イベント３：クリックでid名「frame1」の先頭に追加</p>
  <p class="box3">ボックス３</p>
  <p class="event4">イベント４：ダブルクリックでid名「frame1」の末尾に追加</p>
  <p class="box4">ボックス４</p>
</div>

<div id="frame2">
  <p class="event5">イベント５：ボックス５の中身を削除</p>
  <p class="box5">ボックス５</p>
  <p class="event6">イベント６：id名「frame3」の内容を削除する</p>
  <p class="box6">ボックス６</p>
</div>

<div id="frame3">
  <p class="event7">イベント７</p>
  <p class="box7">ボックス７</p>
  <p class="event8">イベント８</p>
  <p class="box8">ボックス８</p>
  <p class="event9">イベント９</p>
  <p class="box9">ボックス９</p>
  <p class="event10">イベント１０</p>
  <p class="box10">ボックス１０</p>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(function(){
  //■サンプル１
  $('.event1').on('click',function(){
    $('.box1').prepend('<span>prependで追加！</span>');
  });

  $('.event2').on('click',function(){
    $('.box2').append('<span>appendで追加！</span>');
  });

  //■練習１  クラス名「event3」をクリックしたときに
  //          id名「frame1」の先頭に『<p>先頭に追加ボックス！</p>』
  //          を追加する
  $('.event3').on('click', function(){
    $('#frame1').prepend('<p>先頭に追加ボックス！</p>');
  })


  //■練習２  クラス名「event4」をダブルクリックしたときに
  //          id名「frame1」の末尾に『<p>末尾に追加ボックス！</p>』
  //          を追加する
  $('.event4').on('dblclick', function(){
    $('#frame1').append('<p>末尾に追加ボックス！</p>');
  })


  //■サンプル２
  $('.event5').on('click',function(){
    $('.box5').empty();
  });

  //■練習３  クラス名「event6」をクリックしたときに
  //          id名「frame3」の内容を削除する
  $('.event6').on('click', function(){
    $('#frame3').empty();
  })

});
</script>
</body>
</html>
```

#### 複数CSSのスタイルを定義したい場合

- 1つの場合  
`$('p').css('background-color', '#ccf');`

- 複数指定する場合

```html
$("p").css({
    color:"red",
    font-size:"16px",
    font-weight:"bold"
});
```
しかしこの方法だと記述が長くなり3、4つが限界。デザイン変更にも手間がかかる。  
したがってCSS側であらかじめ切り替えるデザインを定義しておいて、class名を切り替える方法をとる。


#### classの付け外し

```html
$('#box1').addClass('名前');
// 対象箇所のクラス属性に値を付与する

$('#box1').removeClass('名前');
// 対象箇所のクラス属性から値を削除する

$('#box1').toggleClass('名前');
// 対象のクラス属性に値を付与/削除する(切替)

$('.event6').on('click',function(){
  $(this).addClass('pickup');
});
// this：イベント発生要素(.event6)を指す
// イベントが起きた自分自身に処理を施すときに使用

```

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>：jQueryを試してみる</title>
<style>
.pickup {
  width: 200px;
  height: 200px;
  background-color: #fcc;
}
</style>
</head>
<body>
<p class="event1">イベント１：クラス追加</p>
<p class="event2">イベント２：クラス削除</p>
<p id="box1" >ボックス１</p>

<p class="event3">イベント３：クラス追加</p>
<p class="event4">イベント４：クラス削除</p>
<p id="box3">ボックス３</p>

<p class="event5">イベント５：クラスを追加・削除</p>
<p id="box5">ボックス５</p>

<p class="event6">イベント６：自分自身にクラス追加</p>

<p class="event7">イベント７：自分自身にクラス追加・削除</p>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(function(){
  //■サンプル１
  $('.event1').on('click',function(){
    $('#box1').addClass('pickup');
  });

  $('.event2').on('click',function(){
    $('#box1').removeClass('pickup');
  });

  //■練習１  クラス名「event3」をクリックしたときに
  //          id名「box3」に「クラス属性:pickup」
  //          を追加する
  $('.event3').on('click', function(){
    $('#box3').addClass('pickup');
  })


  //■練習２  クラス名「event4」をクリックしたときに
  //          id名「box3」から「クラス属性:pickup」
  //          を削除する
  $('.event4').on('click', function(){
    $('#box3').removeClass('pickup');
  })


  //■練習３  クラス名「event5」をクリックしたときに
  //          id名「box5」から「クラス属性:pickup」
  //          を追加・削除する
  $('.event5').on('click', function(){
    $('#box5').toggleClass('pickup');
  })


  //■サンプル２
  $('.event6').on('click',function(){
    $(this).addClass('pickup');
  })

  //■練習４  クラス名「event7」をクリックするたびに
  //          クリックした要素に「クラス属性:pickup」
  //          を追加・削除する
  $('.event7').on('click', function(){
    $(this).toggleClass('pickup');
  })
});
</script>
</body>
</html>
```

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Sort</title>
<link rel="stylesheet" href="common.css" type="text/css">
</head>
<body>
<div id="container">
  <div id="header">
    <h1>商品一覧</h1>
    <ul class="clearfix">
      <li class="outer">アウター</li>
      <li class="bottoms">ボトムス</li>
      <li class="bag">バッグ</li>
      <li class="shoes">シューズ</li>
      <li class="goods">グッズ</li>
    </ul>
  </div><!--#header-->

  <div id="content">
    <h1>新着商品</h1>
    <ul class="clearfix">
      <li class="shoes_item">
        <p><img src="img/01.jpg" alt="シューズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="goods_item">
        <p><img src="img/21.jpg" alt="グッズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="outer_item">
        <p><img src="img/13.jpg" alt="アウター"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bag_item">
        <p><img src="img/07.jpg" alt="バッグ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="shoes_item">
        <p><img src="img/03.jpg" alt="シューズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bag_item">
        <p><img src="img/06.jpg" alt="バッグ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bag_item">
        <p><img src="img/08.jpg" alt="バッグ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="goods_item">
        <p><img src="img/23.jpg" alt="グッズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="outer_item">
        <p><img src="img/12.jpg" alt="アウター"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="shoes_item">
        <p><img src="img/02.jpg" alt="シューズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bag_item">
        <p><img src="img/10.jpg" alt="バッグ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bottoms_item">
        <p><img src="img/19.jpg" alt="ボトムス"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bag_item">
        <p><img src="img/09.jpg" alt="バッグ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bottoms_item">
        <p><img src="img/16.jpg" alt="ボトムス"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="shoes_item">
        <p><img src="img/05.jpg" alt="シューズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="outer_item">
        <p><img src="img/11.jpg" alt="アウター"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bottoms_item">
        <p><img src="img/18.jpg" alt="ボトムス"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="goods_item">
        <p><img src="img/22.jpg" alt="グッズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="outer_item">
        <p><img src="img/14.jpg" alt="アウター"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="shoes_item">
        <p><img src="img/04.jpg" alt="シューズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="outer_item">
        <p><img src="img/15.jpg" alt="アウター"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bottoms_item">
        <p><img src="img/17.jpg" alt="ボトムス"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="goods_item">
        <p><img src="img/24.jpg" alt="グッズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="bottoms_item">
        <p><img src="img/20.jpg" alt="ボトムス"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
      <li class="goods_item">
        <p><img src="img/25.jpg"  alt="グッズ"></p>
        <p class="item">商品名</p>
        <p class="price">○○○○円</p>
      </li>
    </ul>
  </div><!--#content-->

  <div id="footer">練習ファイル</div><!--#footer-->

</div><!--#container-->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(function(){
  $('.outer, .bottoms, .bag, .shoes, .goods').addClass('pickup');
  $('.outer').on('click',function(){
    $(this).toggleClass('pickup');
    $('.outer_item').slideToggle(500);
  });
  //

  // ■練習１
  // 「ボトムス」「バッグ」「シューズ」「グッズ」も
  // ボタンをクリックすることで表示・非表示させる
//   $('.bottoms').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.bottoms_item').slideToggle(500);
//   });
//   $('.bag').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.bag_item').slideToggle(500);
//   });
//     $('.shoes').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.shoes_item').slideToggle(500);
//   });
//   $('.goods').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.goods_item').slideToggle(500);
// });

  // ■練習２
  // 練習１の解答を修正し表示・非表示をスライドに変更する
//   $('.bottoms').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.bottoms_item').slideToggle(500);
//   });
//   $('.bag').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.bag_item').slideToggle(500);
//   });
//     $('.shoes').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.shoes_item').slideToggle(500);
//   });
//   $('.goods').on('click', function(){
//     $(this).toggleClass('pickup');
//     $('.goods_item').slideToggle(500);
// });
  // ■練習３
  // 練習１の解答を修正し表示・非表示をフェイドに変更する
  $('.bottoms').on('click', function(){
    $(this).toggleClass('pickup');
    $('.bottoms_item').fadeToggle(500);
  });
  $('.bag').on('click', function(){
    $(this).toggleClass('pickup');
    $('.bag_item').fadeToggle(500);
  });
    $('.shoes').on('click', function(){
    $(this).toggleClass('pickup');
    $('.shoes_item').fadeToggle(500);
  });
  $('.goods').on('click', function(){
    $(this).toggleClass('pickup');
    $('.goods_item').fadeToggle(500);
});
  // ■練習４
  // 練習１の解答を修正し
  // 対象商品が表示されているボタンに外部CSSで定義されたclass名「pickup」を追加し背景色を表示させること
  // 対象商品が非表示の際はボタンからclass名「pickup」を削除し背景色を元に戻すこと
  // $('.outer, .bottoms, .bag, .shoes, .goods').addClass('pickup');
  // 上記をjQuery開始「$(function(){」直後に追加


});
</script>
</body>
</html>
```

マウスを乗せるとカーソルが手のマークになるCSS  
`cursor: pointer;`  



  $('.question').each(function () {
//$('.question'):場所
//.each：複数ある場所に対し繰り返し処理を行うメソッド

var index = $('.question').index(this);
    console.log(index);
    console.log(question.eq(index));
  });



### slick
jQueryのプラグインの一つ  

[slickの使い方](http://jobtech.jp/js/2165/)
[slick](http://kenwheeler.github.io/slick/)

読み込みの順番
1. CDNからjQuery本体を最初の読み込み
2. CDNからslickの読み込み
3. ローカルからslickのjsファイル読み込み

```html
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>slick</title>
<!-- slick用CSS読み込み -->
<link rel="stylesheet" href="css/slick.css" type="text/css">
<link rel="stylesheet" href="css/slick-theme.css" type="text/css">
<!-- サイトデザイン用CSS読み込み -->
<link rel="stylesheet" href="css/common.css" type="text/css">
</head>
<body>
<div id="container">
  <div id="eyecatch" class="clearfix">
    <div><img src="img/001.jpg" alt="画像"></div>
    <div><img src="img/002.jpg" alt="画像"></div>
    <div><img src="img/003.jpg" alt="画像"></div>
  </div>
  <div class="item_gallery clearfix">
    <div><a href="#"><img src="img/001_small.jpg" alt="画像"></a></div>
    <div><a href="#"><img src="img/002_small.jpg" alt="画像"></a></div>
    <div><a href="#"><img src="img/003_small.jpg" alt="画像"></a></div>
    <div><a href="#"><img src="img/004_small.jpg" alt="画像"></a></div>
    <div><a href="#"><img src="img/005_small.jpg" alt="画像"></a></div>
    <div><a href="#"><img src="img/006_small.jpg" alt="画像"></a></div>
    <div><a href="#"><img src="img/007_small.jpg" alt="画像"></a></div>
  </div>
</div><!--#container-->

<!-- jQuery本体読み込み -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- slickプラグイン読み込み -->
<script src="js/slick.min.js"></script>
<!-- slick実行コード記述 -->
<script>
$(function(){
  $('#eyecatch').slick({
    slidesToShow:1,
    slidesToScroll:1,
    autoplay:true,
    autoplaySpeed:5000,
    fade: true,
    dots: true,

      });

  // ■練習１
  // クラス名「item_gallery」内の画像を3枚が同時に表示されるようにし
  // スライドは1枚ずつ動かすこと
  // またドット表示やスライドスピードを自由に調整すること
  $('.item_gallery').slick({
    slidesToShow: 3,
    slidesToScroll: 4,
    autoplay:true,
    autoplaySpeed:2000,
    centerMode:true,

  });


  // ■練習２
  // 練習１の解答を修正し表示した3枚の画像が中央になるように修正すること
  // ※調整時に左右に見切れた画像が表示されても構わない
});
</script>
</body>
</html>
```



[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
