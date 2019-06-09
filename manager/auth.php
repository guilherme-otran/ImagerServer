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
  $YOUR_AUTH_CODE = 'ABCDE';

  if ( isset($_POST['auth']) && is_string($_POST['auth']) ) {
    $auth = $_POST['auth'];
  } else {
    $auth = '';
  }

  $options_json = $_POST['options'];
  $auth_check = hash_hmac('md5', $options_json, $YOUR_AUTH_CODE);
  $authenticated = ("$auth_check" === "$auth");

  $files = $_FILES;
  $file  = array_pop($files);
  unset($files);

  if ($file && is_uploaded_file($file['tmp_name'])) {
    $file_md5  = md5_file($file['tmp_name']);
    $options_file_md5 = $options->{'file_md5'};

    $authenticated = $authenticated && ("$file_md5" === "$options_file_md5");

    $file_sha1 = sha1_file($file['tmp_name']);
    $options_file_sha1 = $options->{'file_sha1'};

    $authenticated = $authenticated && ("$file_sha1" === "$options_file_sha1");

    unset($file_md5);
    unset($options_file_md5);
    unset($file_sha1);
    unset($options_file_sha1);
  }

  unset($file);

  if (!$authenticated) {
    usleep(rand(1, 2000));
    header("HTTP/1.1 401 Unauthorized", true, 401);
    exit("Auth failed.");
  }
