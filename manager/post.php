<?php
try {
  require('initializer.php');
  require('auth.php');
  require('post_validator.php');
  require('resizer.php');

  $collection = utf8_decode($options->{'collection'});
  $album      = utf8_decode($options->{'album'});

  $collection = substr($collection, 0, 20);
  $album      = substr($album, 0, 20);

  $destination = "$collection/$album/$file_id/";

  if (! is_dir($GLOBALS['ImagePath'] . $destination)) {
    if (!mkdir($GLOBALS['ImagePath'] . $destination, 0777, true)) {
      throw new Exception("Cannot makedir", 1);
    }
    $new = true;
  } else {
    $new = false;
  }

  $accepted_sizes = array();
  $uris           = array();

  foreach ($sizes as $key => $size) {
    $filename = $key . '.jpg';
    $savepath = $GLOBALS['ImagePath'] . $destination . $filename;

    try {
      $saved = ResizeImage($file['tmp_name'], $savepath, $size);
    } catch (Exception $e) {
      header("HTTP/1.1 422 Unprocessable Entity", true, 422);
      exit($e->getMessage());
    }

    if ($saved) {
      array_push($accepted_sizes, $key);
      $uri         = $GLOBALS['ImageBaseURI'] . $destination . $filename;
      $uris[$key]  = $uri;
    }
  }

  $result = array(
    'collection'     => utf8_encode($collection),
    'album'          => utf8_encode($album),
    'file_id'        => utf8_encode($file_id),
    'accepted_sizes' => $accepted_sizes,
    'URIs'           => $uris
  );

  if (sizeof($accepted_sizes) > 0) {
    if ($new) {
      header("HTTP/1.1 201 Created", true, 201);
    }
    echo json_encode($result);
  } else {
    header("HTTP/1.1 422 Unprocessable Entity", true, 422);
  }

} catch (Exception $e) {
  header("HTTP/1.1 500 Internal Server Error", true, 500);
}
