<?php
  require('initializer.php');
  require('auth.php');
  require('delete_validator.php');
  require('deleter.php');

  // This post values are safe here, due to delete_validator
  $to_delete = $options->{'collection'} . '/' . $options->{'album'} . '/' . $options->{'file_id'};

  if (!is_dir($GLOBALS['ImagePath'] . $to_delete)) {
    header("HTTP/1.1 404 Not Found", true, 404);
    die("Cannot find the file.");
  }

  if (!recursive_rmdir($GLOBALS['ImagePath'] . $to_delete)) {
    header("HTTP/1.1 500 Internal Server Error", true, 500);
    die("");
  }

  header("HTTP/1.1 204 No Content", true, 204);
