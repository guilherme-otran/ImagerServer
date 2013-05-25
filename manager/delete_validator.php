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
    isset($_POST['file']) &&
    is_string($_POST['file']) &&
    (strlen($_POST['file']) > 0) &&
    (!preg_match("/[^a-z0-9\-]/i", $_POST['album']))
  )) {
    header("Status: 400 Bad Request");
    die("Invalid file.");
  }

?>