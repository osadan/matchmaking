<?
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
require_once('classes/users.php');
$user->check_user_premmisions(255);
$sd = Utils::giveMeSmarty();
$new_user = new Users();
if($_REQUEST['sub_mit'] != ""){
	if($_REQUEST['user_id'] != ""){
		$new_user->edit($_REQUEST['user_id']);
		header("Location:". SERVER_ROOT ."manageUsers.php?edit=success");
		
	}else{
		$new_user->insert();
		header("Location:". SERVER_ROOT ."manageUsers.php?insert=success");
	}
}else if($_REQUEST['action'] == 'edit'){
	//$sd->script = 
	$new_user->SingleView($_REQUEST['id']);
	$sd->ass("script",$sd->script);
	
}else if ($_REQUEST['action'] == 'delete'){
			$new_user->Delete($_REQUEST['user_id']);
			header("Location:" . SERVER_ROOT . "manageUsers.php");
		}
		else if ($_REQUEST['action'] == 'changePassowrd'){
				
		}


//$sd->displayExtFiles(array("item"),false);
$ref = "ui/jquery.ui.";
$sd->displayExtFiles(array($ref."button"),true);
$sd->displayForm("users.tpl");



?>
