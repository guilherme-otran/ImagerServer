<?php
  session_start();

  // You should create one!
  // This is the same that you set at gem initializer:
  //
  // Imager.config do |config|
  //   config.auth_code = '';
  // end
  //
  // DO NOT USE A BLANK VALUE!
  // Random one yourself or use: https://www.random.org/
  //
  $YOUR_AUTH_CODE = '';

  $authenticated = false;

  if (isset($_POST['auth']) && isset($_SESSION['key']))
  {
    $authenticated = md5($_SESSION['key'] . $YOUR_AUTH_CODE) === $_POST['auth'];
  }

  $_SESSION['key'] = md5(uniqid(rand(), true));

  if (defined('INITIALIZED')) {
    header("Status: 401 Unauthorized");
    exit;
  }

  if (!$authenticated) {
    die($_SESSION['key']);
  }
?>