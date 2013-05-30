<?php
  function getKey() {

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


    $delta_time = 2 * 60; // 2 Minutes

    //date_default_timezone_set("UTC");
    $seconds = time();
    $rounded_seconds = round($seconds / ($delta_time)) * ($delta_time);

    return md5($YOUR_AUTH_CODE . $rounded_seconds);

  }

  $posted = $_POST;

  if ( isset($posted['auth']) && is_string($posted['auth']) ) {
    $auth = $posted['auth'];
    unset($posted['auth']);
  } else {
    $auth = '';
  }

  if (isset($file) && $file) {
    $data_confirm = md5_file($file['tmp_name']) . '&';
  } else {
    $data_confirm = '';
  }

  //$data_confirm .= json_encode($posted);
  $data_confirm .= http_build_query($posted);
  echo($data_confirm);
  $auth_check = hash_hmac('md5', $data_confirm, getKey());

  $authenticated = ("$auth_check" === "$auth");

  if (!$authenticated) {
    header("Status: 401 Unauthorized");
    exit("Auth failed");
  }
?>