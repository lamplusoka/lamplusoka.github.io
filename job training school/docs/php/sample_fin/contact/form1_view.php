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
