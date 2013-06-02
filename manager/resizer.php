<?php

if (!defined('INITIALIZED')) {
  header("HTTP/1.1 404 Not Found", true, 404);
  exit;
}

function ResizeImage($source, $destination, $size)
{

  $source = imagecreatefromstring(file_get_contents($source));

  if ( $size === 'original' ) {

    if (! imagejpeg($source, $destination, 50) ) {
      throw new Exception("Fail on save image", 1);
    }
    imagedestroy($source);
    return true;

  }

  $x = imagesx($source);
  $y = imagesy($source);

  if ( ($x<1) || ($y<1) ){
    throw new Exception("Invalid image size", 1);
  }

  $w = 0;
  $h = 0;

  if ( isset($size['width']) ) {
    $w = $size['width'];
    $h = ($w * $y) / $x;
  }

  if ( isset($size['height']) ) {

    if ( (!$w) || ($h > $size['height']) ) {
      $h = $size['height'];
      $w = ($x * $h) / $y;
    }

  }

  if ($w && $h) {

    $slate = imagecreatetruecolor($w, $h);
    imagecopyresampled($slate, $source, 0, 0, 0, 0, $w, $h, $x, $y);
    if (! imagejpeg($slate, $destination, 70) ) {
      throw new Exception("Fail on save image", 1);
    }
    imagedestroy($slate);
    imagedestroy($source);
    return true;

  }

  return false;
}
?>