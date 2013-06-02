<?php
  if (!defined('INITIALIZED')) {
    header("HTTP/1.1 404 Not Found", true, 404);
    exit;
  }

  function recursive_rmdir($dir) {
    if (is_file($dir)) {
      return unlink($dir);
    }

    if (is_dir($dir)) {
      foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;

        if (!recursive_rmdir($dir . DIRECTORY_SEPARATOR . $item)) {
          break;
          return false;
        }
      }
      return rmdir($dir);
    }

    return false;
  }
?>