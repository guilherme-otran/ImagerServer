<?php
  // Prevent direct access
  if (!defined('INITIALIZED')) {
    header("Status: 404 Not Found");
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
    header("Status: 400 Bad Request");
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
    header("Status: 400 Bad Request");
    die("Invalid album");
  }

  if (! (
    isset($_POST['sizes']) &&
    is_array($_POST['sizes'])
  )) {
    header("Status: 400 Bad Request");
    die("Sizes must be an array");
  }

  foreach ($_POST['sizes'] as $key => $value) {
    if (!is_string($key)) {
      header("Status: 400 Bad Request");
      die("Invalid key $key for sizes");
    }

    if (strlen($key) < 2) {
      header("Status: 400 Bad Request");
      die("Invalid key $key. Must be grater than 2");
    }

    if(preg_match("/[^a-z0-9]/i", $key)) {
      header("Status: 400 Bad Request");
      die("Invalid key $key for sizes");
    }
  }

  $sizes = $_POST['sizes'];

  // Must have a file uploaded
  $file = array_pop($_FILES);
  if (!$file) {
    header("Status: 400 Bad Request");
    exit;
  }

  if (!is_uploaded_file($file['tmp_name'])) {
    header("Status: 400 Bad Request");
    exit;
  }

  // The file name should have a extension
  $file_id = utf8_decode($file['name']);
  $file_id = removeAcentos($file_id);
  // Remove .jpg or other extension.
  $file_id = substr($file_id, 0, -4);
  if (strlen($file_id) < 1) {
    header("Status: 400 Bad Request");
    exit;
  }

?>