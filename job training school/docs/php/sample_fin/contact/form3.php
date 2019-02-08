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

$name    = $_SESSION['name'];
$email   = $_SESSION['email'];
$subject = $_SESSION['subject'];
$body    = $_SESSION['body'];
$mailTo  = 'company@example.com';
$returnMail = 'error@example.com';
/*
mb_language('ja');
mb_internal_encoding('UTF-8');
*/
/*$header = 'From: ' . mb_encode_mimeheader($name) . ' <' . $email . '>';

$result = mb_send_mail($mailTo, $subject, $body, $header, '-f ' . $returnMail);
*/
$message = true;
if ($result) {
  $message =  '送信完了！';
} else {
  $message = '送信失敗';
}
$_SESSION = array();
session_destroy();

$message = h($message);
require 'form3_view.php';
