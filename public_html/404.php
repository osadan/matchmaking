<?
	require_once ('libs/settings.php');
	require_once('classes/dbHandler.php');
	$sd = new smartyDisplay($smarty);
	$sd->displayExtFiles(array("item"),false);
	$ref = "ui/jquery.ui.";
	$sd->displayExtFiles(array($ref."core",$ref."widget",$ref."button","main"),true);
	$sd->displayForm("messages/noPremission.tpl");

?>