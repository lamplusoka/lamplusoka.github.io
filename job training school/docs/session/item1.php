<?php

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品ページ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php

?>
<div id="container">
  <div id="cart">
    <h1>カートの中</h1>
    <div id="cart_item"><?php echo $cart; ?></div>
    <p><a href="delete.php">カートクリア</a></p>
  </div>
  <div id="item">
  <h1>商品詳細</h1>
    <form action="add.php" method="post">
      <p><label><input type="radio" name="itemnum" value="1">鉛筆</label></p>
      <p><input type="submit" value="カートに入れる"></p>
    </form>
  </div>
  <div id="pickup">
    <h2>おすすめ商品</h2>
    <p><a href="item1.php">鉛筆</a></p>
    <p><a href="item2.php">ボールペン</a></p>
    <p><a href="item3.php">消しゴム</a></p>
  </div>
</div>
</body>
</html>
