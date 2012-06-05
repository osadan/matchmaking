<?
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
require_once('classes/users.php');
$user->check_user_premmisions(255);
$sd = Utils::giveMeSmarty();
$conn = Utils::giveMeConnection();
$user = new Users();
//print_r($_REQUEST);
$itemsPerPage = 10;
$start = $_REQUEST['s'] ?  $_REQUEST['s'] : 0;
$limit = $_REQUEST['l'] ? $_REQUEST['l'] : $itemsPerPage ;
$total = $conn->GetOne( "select count(*) from users");
$find = $_REQUEST['find'];
if($find != ""){
	$where = "where firstName like '%".$find."%' or lastName  like '%".$find."%' or nickName like '%".$find."%'";
}
$sd->ass("last",floor($total/$itemsPerPage));
$sd->ass("cur",$start);
$sd->ass("find",$find);
$list = $conn->getAll("select * from users $where order by id desc limit ".$start.",".$limit);
foreach ($list as $key=>$value)
{
	$value['premmisions'] = Utils::getPremmisonByNum( $value['premmisions']);
	$sd->append('list',$value);
}
if ($_REQUEST['edit'] == 'success'){
	$sd->message('העדכון בוצע בהצלחה',true);
}
if ($_REQUEST['insert'] == 'success'){
		$sd->message('המשתמש הוזן בהצלחה',true);
}
$sd->message_disappear(2000);
$sd->displayExtFiles(array("item"),false);
$ref = "ui/jquery.ui.";
$sd->displayExtFiles(array($ref."button","main"),true);
$sd->displayForm("manageUsers.tpl");
?>