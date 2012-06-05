<?php
require_once ('helper_classes.php');
require_once('adodb5/adodb-exceptions.inc.php');
require_once('adodb5/adodb.inc.php');
require_once('adodb5/tohtml.inc.php');
require_once('./classes/generic.php');
require_once('./classes/Items.php');
require_once('./classes/defanitions.php');
require_once('./classes/Dates.php');
require_once("./libs/krumo/class.krumo.php");
require_once("./libs/smarty_functions.php");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define("BR","<br />");
define("DBDRIVER",'mysql');
define("DEBUG",false);
switch ($_SERVER['SERVER_NAME']){
	case 'project.videoincreasesales.com':
		require_once('Smarty/libs/Smarty.class.php');//site
		$smarty = new Smarty();
		$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/templates/';
		$smarty->compile_dir  = $_SERVER['DOCUMENT_ROOT'].'/templates_c/';
		$smarty->config_dir   = $_SERVER['DOCUMENT_ROOT'].'/configs/';
		$smarty->cache_dir    = $_SERVER['DOCUMENT_ROOT'].'/cache/';
		define('DB_USERNAME','videoinc_project');
		define ('DB_PASSWORD','netuser');
		define ('DB_NAME','videoinc_project');
		//host352.hostmonster.com
		//project.videoincreasesales.com
		define ('DB_SERVER','localhost');
		//define ('DB_SERVER','host352.hostmonster.com');
		define("SERVER_ROOT",'/public_html/');
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
		define("SERVER_ROOT",'/');
	break;
	case "dev.s":
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
		define("SERVER_ROOT",'/');
	break;
	case "good.luck":
	case 'www.good.luck':
		require_once('../Smarty-2.6.18/libs/Smarty.class.php');
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
		define("SERVER_ROOT",'/');
	break;
	
	case "localhost":
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
		define("SERVER_ROOT",'/shiduchim1.0/public_html/');
	break;
	case "local.matchmaking.com":
		
		require_once('./../Smarty-2.6.18/libs/Smarty.class.php');
		//echo 'here';
		$smarty = new Smarty();
		$smarty->template_dir = './../templates';
		$smarty->compile_dir  = './../templates_c';
		$smarty->config_dir   = './../configs';
		$smarty->cache_dir    = './../cache';
		//db cardinatials
		define('DB_USERNAME','root');
		define ('DB_PASSWORD','root');
		define ('DB_NAME','shiduchim');
		define ('DB_SERVER','localhost');
		define("SERVER_ROOT",'/');
	break;
	
}

$smarty->assign('SERVER_ROOT',SERVER_ROOT);


$conn = Utils::giveMeConnection();
$user = new ActiveUser();
$user->checkUser();	

$smarty->register_function ('candidate','show_candidate_details_short');
$smarty->register_function ('candidate_expended' ,'show_canidate_expended');
$smarty->register_function('institution_list','get_all_institutions_list');
$smarty->register_function ('last_meetings','homepage_view_last_meeting');

function breakpoint()
{
	ob_flush();
	flush();
	sleep(.1);
	//debugBreak();
}
	
?>