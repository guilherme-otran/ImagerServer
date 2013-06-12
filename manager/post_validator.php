<?php
  // Prevent direct access
  if (!defined('INITIALIZED')) {
    header("HTTP/1.1 404 Not Found", true, 404);
    exit;
  }

  // Collection must be present and be a string
  // Cannot contain any special chars
  if (! (
    isset($_POST['collection']) &&
    is_string($_POST['collection']) &&
    (strlen($_POST['collection']) > 0) &&
    (!preg_match("/[^a-z0-9]/i", $_POST['collection']))
  )) {
    header("Status: 422 Unprocessable Entity");
    die("Invalid collection");
  }

  // Album must be present and be a string
  // Cannot contain any special chars
  if (! (
    isset($_POST['album']) &&
    is_string($_POST['album']) &&
    (strlen($_POST['album']) > 0) &&
    (!preg_match("/[^a-z0-9]/i", $_POST['album']))
  )) {
    header("Status: 422 Unprocessable Entity");
    die("Invalid album");
  }

  if (! (
    isset($_POST['sizes']) &&
    is_array($_POST['sizes'])
  )) {
    header("Status: 422 Unprocessable Entity");
    die("Sizes must be an array");
  }

  foreach ($_POST['sizes'] as $key => $value) {
    if (!is_string($key)) {
      header("Status: 422 Unprocessable Entity");
      die("Invalid key $key for sizes");
    }

    if (strlen($key) < 2) {
      header("Status: 422 Unprocessable Entity");
      die("Invalid key $key. Must be grater than 2");
    }

    if(preg_match("/[^a-z0-9]/i", $key)) {
      header("Status: 422 Unprocessable Entity");
      die("Invalid key $key for sizes");
    }
  }

  $sizes = $_POST['sizes'];

  // Must have a file uploaded
  $file = array_pop($_FILES);
  if (!$file) {
    header("Status: 422 Unprocessable Entity");
    exit("Must have a file.");
  }

  if (!is_uploaded_file($file['tmp_name'])) {
    header("Status: 422 Unprocessable Entity");
    exit("File upload failed.");
  }

  if (! (
    isset($_POST['file_id']) &&
    is_string($_POST['file_id']) &&
    (strlen($_POST['file_id']) > 1)
  )) {
    header("Status: 422 Unprocessable Entity");
    die("Invalid file name");
  }

  $file_id = utf8_decode($_POST['file_id']);
  if ( preg_match("/[^a-z0-9\-]/i", $file_id) ) {
    header("Status: 422 Unprocessable Entity");
    exit("File name contains illegal chars.");
  }

?>