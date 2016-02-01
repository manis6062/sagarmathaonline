<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

define('SITE_NAME', 'HSC');
define('ADMIN_AUTH_USERID', 'airborntv_admin_userid');
define('ADMIN_AUTH_USERNAME', 'airborntv_admin_username');
define('ADMIN_AUTH_TYPE', 'airborntv_admin_type');
define('ADMIN_PATH', 'administrator/');
define('ADMIN_CSS', 'style/backend/');
define('ADMIN_JS', 'js/admin/');
define('offsetsmall','0');
define('offsetlarge','0');
define('PRODUCT_IMAGE_PATH','./uploads/products/');
define('PUB_IMAGE_PATH','./uploads/home_publication/');
define('SOCIAL_IMAGE_PATH','./uploads/social/');
define('POLL_IMAGE_PATH','./uploads/poll/');
define('CHARACTER_IMAGE_PATH','./uploads/character/');
define('CARTOON_IMAGE_PATH','./uploads/cartoon/');
define('NEWS_IMAGE_PATH','./uploads/news/');
define('CLIENT_IMAGE_PATH','./uploads/client/');
define('PUBLICATION_PATH','./uploads/publication/');
define('TEAM_PATH','./uploads/team/');
define('CROP_PATH', 'http://localhost/emcheppav/application/helpers/'); 
define('GALLERY_PATH', 'http://localhost/emcheppav/uploads/products/'); 
define('BANNER_IMAGE_PATH','./uploads/banner/');
define('ADVERTISEMENT_IMAGE_PATH','./uploads/advertisement/');
define('SlIDER_IMAGE_PATH','./uploads/slider/');