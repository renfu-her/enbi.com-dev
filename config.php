<?php
session_start();
ini_set('display_errors', 0);
if($_GET['debug'] == 'cldd'){
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE);
}
if(!defined(ROOT))		
	define('ROOT',dirname(__FILE__).'/');

if(!defined(libs))        
	define('libs',dirname(__FILE__).'/libs/');

if(!defined(icld))        
	define('icld',dirname(__FILE__).'/include/');

	
include_once libs.'MyDB.php';
include_once libs.'SimpleSQL.php';
include_once libs.'func.php' ;
include_once libs.'Mobile_Detect.php' ;


$conn_host	= '127.0.0.1';
$conn_db	= 'goodwayt_Enbi';
$conn_user	= 'enbi';
$conn_pass	= '4icexibrepe5hEru9adr';


define("mail_server","smtp.gmail.com");
define("mail_login_name","enbiservice@gmail.com");
define("mail_login_pass","ubqfiteepubjbgou");
define("smtp_port","465");

// gmail acc
// enbiservice@gmail.com
// TZyzt7ZayXJ4Ea4R

// google備用碼
// 6889 2926   
// 0164 1818
// 2563 3143   
// 3765 1216
// 7591 8443   
// 4716 4288
// 4358 6894   
// 9122 1778
// 1090 8896   
// 5377 2914


$mydb = new MyDB($conn_host , $conn_db , $conn_user , $conn_pass);
$mydb->SqlQuery("SET NAMES utf8");



$obj_admin_log                          = new SimpleSQL($mydb , 'c_admin_log');
$obj_banner								= new SimpleSQL($mydb , 'c_banner');
$obj_story								= new SimpleSQL($mydb , 'c_story');
$obj_news								= new SimpleSQL($mydb , 'c_news');
$obj_category							= new SimpleSQL($mydb , 'c_category');
$obj_products							= new SimpleSQL($mydb , 'c_products');
$obj_contact							= new SimpleSQL($mydb , 'c_contact');
$obj_admin								= new SimpleSQL($mydb , 'c_admin');
$obj_store								= new SimpleSQL($mydb , 'c_store');




$server_root = ROOT.'uploads/';

$ary_config['ckeditorUploadUrl'] = '/uploads/';


$ary_post = safe($_REQUEST);
$ary_get = safe($_GET);







