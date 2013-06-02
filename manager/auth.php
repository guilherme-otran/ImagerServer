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

  $files = $_FILES;
  $file  = array_pop($files);
  unset($files);


  if ($file && is_uploaded_file($file['tmp_name'])) {
    $posted['file_md5']  = md5_file($file['tmp_name']);
    $posted['file_sha1'] = sha1_file($file['tmp_name']);
    $posted['file_name'] = ($file['name']);
  }
  unset($file);

  $data_confirm = http_build_query($posted);
  $auth_check   = hash_hmac('md5', $data_confirm, $YOUR_AUTH_CODE);

  $authenticated = ("$auth_check" === "$auth");

  if (!$authenticated) {
    usleep(rand(1, 2000));
    header("HTTP/1.1 401 Unauthorized", true, 401);
    exit("Auth failed.");
  }
?>