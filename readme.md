Imager Server API

Use with Imager gem(not existent yet)

Setup:
Random one token(key) for you and place at manager/auth.php
```php
$YOUR_AUTH_CODE = '';
```
Set this other two vars in manager/initializer:
Your app root. If you place the manager folder in /home/youruser/public_html/somesubdomainfolder/manager you should set as:
```php
$GLOBALS['APP_ROOT']   = '/home/youruser/public_html/somesubdomainfolder/';
```
Or Windows:
```
$GLOBALS['APP_ROOT']   = 'C:\Users\youruser\public_html\somesubdomainfolder\';
```

And this is where the images will be saved. If you want save at /home/youruser/public_html/somesubdomainfolder/images set like:
```
$GLOBALS['IMAGES_DIR'] = 'images/';
```
Don't forget the '/' (or '\' for windows) at the end.

For save at /home/youruser/public_html/somesubdomainfolder/ leave blank
```
$GLOBALS['IMAGES_DIR'] = '';
```

Set permissions of images or somesubdomainfolder.
Remember to not set 0777 the manager folder.

If you are in windows just use '\' instead '/' and place the unit.

The folder tests contain html forms for checking if everything is ok. Just access it from your server. The folder must be at same root of manager.