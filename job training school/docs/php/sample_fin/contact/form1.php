<?php
session_start();
session_regenerate_id(TRUE);

require_once dirname(__FILE__).'/functions.php';

$name    = isset($_SESSION['name'])    ? $_SESSION['name']    : NULL;
$email   = isset($_SESSION['email'])   ? $_SESSION['email']   : NULL;
$subject = isset($_SESSION['subject']) ? $_SESSION['subject'] : NULL;
$body    = isset($_SESSION['body'])    ? $_SESSION['body']    : NULL;

if (!isset($_SESSION['ticket'])) {
  $_SESSION['ticket'] = sha1(uniqid(mt_rand(), TRUE));
  //sha1(文字列):文字列１のSHA1ハッシュ値を計算して、40文字の16進数で返します
  //uniqid(第一, [true|false]):時刻を元にユニークな(一意な)IDを生成。()に文字列や関数を入れるとプレフィックスとなる。
  //trueを入れるとより細かなIDを生成。
  //mt_rand():よりよい乱数を生成する関数

}
$ticket = $_SESSION['ticket'];

$name    = h($name);
$email   = h($email);
$subject = h($subject);
$body    = h($body);
$ticket  = h($ticket);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>メールフォーム</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen,tv">
</head>
<body>
<div id="box">
<div id="header">
<h1>メールフォーム</h1>
</div>
<div id="main">

<?php if (isset($error)): ?>
<ul class="error">
<?php foreach ($error as $val): ?>
<li><?php echo $val; ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<form action="form2.php" method="post">
  <dl>
  <dt>お名前</dt>
  <dd><label>
  <input type="text" name="name" value="<?php echo $name; ?>" size="50">
  </label></dd>
  <dt>e-mail</dt>
  <dd><label>
  <input type="text" name="email" value="<?php echo $email; ?>" size="50">
  </label></dd>
  <dt>件名</dt>
  <dd><label>
  <input type="text" name="subject" value="<?php echo $subject; ?>" size="50">
  </label></dd>
  <dt>内容</dt>
  <dd><label>
  <textarea name="body" cols="50" rows="10"><?php echo $body; ?></textarea>
  </label></dd>
  </dl>
  <p class="btn">
  <input type="submit" value="確認画面へ">
  </p>
  <input type="hidden" name="ticket" value="<?php echo $ticket; ?>">
</form>
</div>
<p class="copy">&copy; メールフォーム</p>
</div>
</body>
</html>
