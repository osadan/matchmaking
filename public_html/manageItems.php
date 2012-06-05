<?php
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
//page defanitons
$user->check_user_premmisions(255);
$sd = Utils::giveMeSmarty();
$items = new Items();
$defanitions  = new Defanitions();

$data = $defanitions->jsonData($defanitions->plurelView(""));

$items->setSelect($smarty);

$smarty->assign("data",$data);

$sd->displayExtFiles(array("base/jquery.ui.all"),false);
$ref = "ui/jquery.ui.";
$sd->displayExtFiles(array($ref."button"),true);
$sd->displayForm("manageItems.tpl");

?>