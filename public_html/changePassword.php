<?
	require_once ('libs/settings.php');
	require_once('classes/dbHandler.php');
	$sd = new smartyDisplay($smarty);
	$sd->displayExtFiles(array("item"),false);
	if($_REQUEST["sub_mit"] != "" && $_REQUEST['user_id'] != ""){
		$query = "select * from users where id = ".$_REQUEST['user_id'];
		$conn = Utils::giveMeConnection();				
		$res = $conn->GetAll($query);
		if (md5($_REQUEST['old']) == $res[0]['password']){
			$query = "update users set password = '" . md5($_REQUEST['new']) . "' where id = ".$_REQUEST['user_id']; 
			$conn->Execute($query);
			header("Location:". SERVER_ROOT. "users.php?c=good");
		}else{
			$sd->ass('message',"הסיסמא הישנה שהקלדת שגויה ");
		}
	}
	$sd->ass('user_id',$_REQUEST['user_id']);
	$ref = "ui/jquery.ui.";
	$sd->displayExtFiles(array($ref."button","main"),true);
	$sd->displayForm("changePassword.tpl");

?>