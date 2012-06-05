<?php
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
$sd = new smartyDisplay($smarty);
//TODO design objects to recive the selections and then generate the query and the redirect to results page 
//TODO add an option in the objects to edit and view the selections 


$sd->displayExtFiles(array("base/jquery.ui.all"),false);
$ref = "ui/jquery.ui.";
$sd->displayExtFiles(array($ref."button",'list'),true);
$sd->displayForm("list.tpl");

?>