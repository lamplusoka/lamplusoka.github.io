<?php
session_start();
require_once dirname(__FILE__).'/functions.php';

$_POST = checkInput($_POST);

if (isset($_POST['ticket'], $_SESSION['ticket'])) {
  $ticket = $_POST['ticket'];
  if ($ticket !== $_SESSION['ticket']) {
    die('不正アクセスの疑いがあります。');
  }
} else {
  die('不正アクセスの疑いがあります。');
}

$name    = isset($_POST['name'])    ? $_POST['name']    : NULL;
$email   = isset($_POST['email'])   ? $_POST['email']   : NULL;
$subject = isset($_POST['subject']) ? $_POST['subject'] : NULL;
$body    = isset($_POST['body'])    ? $_POST['body']    : NULL;

$name    = trim($name);
//trim():最初および最後から空白文字を取り除き、 取り除かれた文字列を返します。
$email   = trim($email);
$subject = trim($subject);
$body    = trim($body);

$error = array();

if ($name == '') {
  $error[] = 'お名前は必須項目です。';
} else if (mb_strlen($name) > 100) {
  //mb_strlen():文字列の長さを取得します。
  $error[] = 'お名前は100文字以内でお願い致します。';
}

if ($email == '') {
  $error[] = 'メールアドレスは必須項目です。';
} else {
  $pattern =
    '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD';
  if (!preg_match($pattern, $email)) {
    $error[] = 'メールアドレスの形式が正しくありません。';
  }
}

if ($subject == '') {
  $error[] = '件名は必須項目です。';
} else if (mb_strlen($subject) > 100) {
  $error[] = '件名は100文字以内でお願い致します。';
}

if ($body == '') {
  $error[] = '内容は必須項目です。';
} else if (mb_strlen($body) > 500) {
  $error[] = '内容は500文字以内でお願い致します。';
}

if (count($error) > 0) {
  $error   = h($error);
  $name    = h($name);
  $email   = h($email);
  $subject = h($subject);
  $body    = h($body);
  $ticket  = h($ticket);
  require 'form1_view.php';
} else {
  $_SESSION['name']    = $name;
  $_SESSION['email']   = $email;
  $_SESSION['subject'] = $subject;
  $_SESSION['body']    = $body;
  $name    = h($name);
  $email   = h($email);
  $subject = h($subject);
  $body    = h($body);
  $ticket  = h($ticket);
  require 'form2_view.php';
}
