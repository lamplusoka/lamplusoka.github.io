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
}
$ticket = $_SESSION['ticket'];

$name    = h($name);
$email   = h($email);
$subject = h($subject);
$body    = h($body);
$ticket  = h($ticket);

require 'form1_view.php';
