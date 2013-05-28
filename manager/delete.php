<?php
  require('initializer.php');
  require('auth.php');
  require('delete_validator.php');
  require('deleter.php');

  // This post values are safe here, due to delete_validator
  $to_delete = $_POST['collection'] . '/' . $_POST['album'] . '/' . $_POST['file_id'];

  if (!is_dir($GLOBALS['ImagePath'] . $to_delete)) {
    header("Status: 404 Not Found");
    die("Cannot find the file.");
  }

  if (!recursive_rmdir($GLOBALS['ImagePath'] . $to_delete)) {
    header("Status: 500 Internal Server Error");
    die("");
  }

  header("Status: 204 No Content");
?>