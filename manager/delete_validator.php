<?php
  // Prevent direct access
  if (!defined('INITIALIZED')) {
    header("HTTP/1.1 404 Not Found", true, 404);
    exit;
  }

  // Collection must be present and be a string
  // Cannot contain any special chars
  if (! (
    isset($options->{'collection'}) &&
    is_string($options->{'collection'}) &&
    (strlen($options->{'collection'}) > 0) &&
    (!preg_match("/[^a-z0-9]/i", $options->{'collection'}))
  )) {

    header("Status: 422 Unprocessable Entity");
    die("Invalid collection");
  }

  // Album must be present and be a string
  // Cannot contain any special chars
  if (! (
    isset($options->{'album'}) &&
    is_string($options->{'album'}) &&
    (strlen($options->{'album'}) > 0) &&
    (!preg_match("/[^a-z0-9]/i", $options->{'album'}))
  )) {

    header("Status: 422 Unprocessable Entity");
    die("Invalid album");
  }

  if (! (
    isset($options->{'file_id'}) &&
    is_string($options->{'file_id'}) &&
    (strlen($options->{'file_id'}) > 0) &&
    (!preg_match("/[^a-z0-9\-]/i", $options->{'file_id'}))
  )) {
    header("Status: 422 Unprocessable Entity");
    die("Invalid file_id.");
  }
