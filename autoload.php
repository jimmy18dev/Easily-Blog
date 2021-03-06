<?php
session_start();
// session_regenerate_id(true); // regenerated the session, delete the old one.
ob_start();
define('StTime', microtime(true));

date_default_timezone_set('Asia/Bangkok');
// error_reporting(E_ALL ^ E_NOTICE);

define("VERSION",'1.0');

require_once 'config/config.php';
require_once 'config/image.config.php';

require_once 'class/database.class.php';
require_once 'class/location.class.php';
require_once 'class/image.class.php';
require_once 'class/article.class.php';
require_once 'class/document.class.php';
require_once 'class/category.class.php';
require_once 'class/user.class.php';
require_once 'class/signature.class.php';
require_once 'class/homesection.class.php';
require_once 'class/member.class.php';

$wpdb = new Database; // DATABASE CONNECT...
$user = new User;

$user->sec_session_start();
$user_online = $user->loginChecking();
?>