<?php
//require_once('smartyClassLocation.php');
require_once ('tsedek.php');
require_once('adodb5/adodb-exceptions.inc.php');
require_once('adodb5/adodb.inc.php');
require_once('adodb5/tohtml.inc.php');
//echo "tsedek init";
define("BR","<br />");
define("DBDRIVER",'mysql');
define("DEBUG",false);
//echo "here";
//print_r($_SERVER);
switch ($_SERVER['SERVER_NAME']){
	case 'project.videoincreasesales.com':
		//echo "servere1";
		require_once('Smarty/libs/Smarty.class.php');//site
		$smarty = new Smarty();
		//$dir ='C:\xampp\htdocs\legal';
		$smarty->template_dir = 'templates/';
		$smarty->compile_dir  = 'templates_c/';
		$smarty->config_dir   = 'configs/';
		$smarty->cache_dir    = 'cache/';
		//db cardinatials
		define('DB_USERNAME','videoinc_project');
		//define ('DB_PASSWORD','BH30project');
		define ('DB_PASSWORD','netuser');
		define ('DB_NAME','videoinc_project');
		//define ('DB_SERVER','host352.hostmonster.com');
		define ('DB_SERVER','localhost');
		//echo DB_SERVER.BR.DB_USERNAME.BR.DB_PASSWORD.BR.DB_NAME;
				
		//define ('DB_SERVER','localhost');
		break;
	case 'dev2.shid.com':
		//echo "servere2";
		require_once('Smarty.class.php');
		$smarty = new Smarty();
		$smarty->template_dir = '../templates';
		$smarty->compile_dir  = '../templates_c';
		$smarty->config_dir   = '../configs';
		$smarty->cache_dir    = '../cache';
		//db cardinatials
		define('DB_USERNAME','root');
		define ('DB_PASSWORD','');
		define ('DB_NAME','shiduchim');
		define ('DB_SERVER','localhost');
	break;	
}
?>