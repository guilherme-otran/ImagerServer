<?php
try {
  require('initializer.php');
  require('auth.php');
  require('post_validator.php');
  require('resizer.php');

  $collection = utf8_decode($_POST['collection']);
  $album      = utf8_decode($_POST['album']);

  $collection = substr($collection, 0, 20);
  $album      = substr($album, 0, 20);

  $destination = "$collection/$album/$file_id/";
  $files       = array();
  $uris        = array();

  if (! is_dir($GLOBALS['ImagePath'] . $destination)) {
    if (!mkdir($GLOBALS['ImagePath'] . $destination, 0777, true)) {
      throw new Exception("Cannot makedir", 1);
    }
    $new = true;
  } else {
    $new = false;
  }

  foreach ($sizes as $key => $size) {
    $filename = $key . '.jpg';
    $savepath = $GLOBALS['ImagePath'] . $destination . $filename;
    $saved    = ResizeImage($file['tmp_name'], $savepath, $size);
    if ($saved) {
      $files[$key] = $filename;
      $uri         = $GLOBALS['ImageBaseURI'] . $destination . $filename;
      $uris[$key]  = $uri;
    }
  }

  $result = array(
    'collection'  => utf8_encode($collection),
    'album'       => utf8_encode($album),
    'file_id'     => utf8_encode($file_id),
    'image_sizes' => $files,
    'URIs'        => $uris
  );

  if (sizeof($files) > 0) {
    if ($new) {
      header("Status: 201 Created");
    } else {
      header("Status: 200 OK");
    }
    echo json_encode($result);
  } else {
    header("Status: 422 Unprocessable Entity");
  }

} catch (Exception $e) {
  header("Status: 500 Internal Server Error");
}
?>