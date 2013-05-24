<?php

$GLOBALS['APP_ROOT']   = '/home/user/projects/imager_server/';
$GLOBALS['IMAGES_DIR'] = 'images/';

 // Uncomment for production
 // URL Initializer
 $url    = $_SERVER['PHP_SELF'];
 $url    = explode('/', $url);

 $script = $_SERVER['SCRIPT_FILENAME'];
 $script = explode('/', $script);

 $root   = $GLOBALS['APP_ROOT'];
 $root   = explode('/', $root);

 $script = array_diff($script, $root);
 $root   = array_diff($url,    $script);
 $url    = '/';
 foreach ($root as $value) {
   if ($value) {
     $url = $url . $value . '/';
   }
 }
 $GLOBALS['APP_URL'] = $url;

unset($script);
unset($root);
unset($url);

$GLOBALS['ImagePath'] = $GLOBALS['APP_ROOT'] . $GLOBALS['IMAGES_DIR'];
$GLOBALS['ImageBaseURI']  = 'http://' . $_SERVER["HTTP_HOST"] . $GLOBALS['APP_URL'] . $GLOBALS['IMAGES_DIR'];

define('INITIALIZED', true);
?>