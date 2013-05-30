<?php

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

  $posted = $_POST;

  if ( isset($posted['auth']) && is_string($posted['auth']) ) {
    $auth = $posted['auth'];
    unset($posted['auth']);
  } else {
    $auth = '';
  }

  if (isset($file) && $file) {
    $data_confirm  = md5_file($file['tmp_name']);
    $data_confirm .= sha1_file($file['tmp_name']);

    $data_confirm .= http_build_query($file['name']);
  } else {
    $data_confirm = '';
  }

  //$data_confirm .= json_encode($posted);
  $data_confirm .= http_build_query($posted);
  echo($data_confirm);
  $auth_check = hash_hmac('md5', $data_confirm, $YOUR_AUTH_CODE);

  $authenticated = ("$auth_check" === "$auth");

  if (!$authenticated) {
    sleep(rand(1, 100));
    header("Status: 401 Unauthorized");
    exit("Auth failed");
  }
?>