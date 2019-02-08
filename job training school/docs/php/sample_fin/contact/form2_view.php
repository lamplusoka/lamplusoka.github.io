<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>内容確認</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen,tv">
</head>
<body>
<div id="box">
<div id="header">
<h1>内容確認</h1>
</div>
<div id="main">

<p>以下の内容でよろしければ送信ボタンを押してください。</p>

<dl>
  <dt>お名前：</dt>
  <dd><?php echo $name; ?></dd>
  <dt>e-mail：</dt>
  <dd><?php echo $email; ?></dd>
  <dt>件名：</dt>
  <dd><?php echo $subject; ?></dd>
  <dt>内容：</dt>
  <dd><?php echo nl2br($body); ?></dd>
</dl>

<div>
<form action="form1.php" method="post">
  <p><input type="submit" value="入力画面に戻る"></p>
</form>
<form action="form3.php" method="post">
  <input type="hidden" name="ticket" value="<?php echo $ticket; ?>">
  <p><input type="submit" value="送信する"></p>
</form>
</div>
</div>
<p class="copy">&copy; メールフォーム</p>
</div>
<p><a href="csrf.php">csrf.php</a></p>
</body>
</html>
