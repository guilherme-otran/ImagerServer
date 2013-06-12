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
    isset($_POST['file_id']) &&
    is_string($_POST['file_id']) &&
    (strlen($_POST['file_id']) > 0) &&
    (!preg_match("/[^a-z0-9\-]/i", $_POST['file_id']))
  )) {
    header("Status: 422 Unprocessable Entity");
    die("Invalid file_id.");
  }

?>