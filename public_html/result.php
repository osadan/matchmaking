<?
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
require_once('classes/Dates.php');
require_once('classes/QueryGenerator.php');
$sd = Utils::giveMeSmarty();
$conn = Utils::giveMeConnection();
$sd->displayExtFiles(array("base/jquery.ui.all"),false);
global $smarty;

if (!empty($_REQUEST['search_type']) && $_REQUEST['search_type'] == 'global-search'){
	$data['general'] = $_REQUEST['search'] ;
	$data['relatives'] = $_REQUEST['search'] ;
	$data['institutions'] = $_REQUEST['search'];
	$q = new QueryGenerator();
	$result = $q->setGenralQuery($data,false);
	$main_details = new MainDetails();
	$arr = $main_details->plurelView($result);
	$smarty->assign('search_value',$_REQUEST['search']);
}
else{
	$q = new QueryGenerator();
	$q->setArrays();
	$query  = $q->getQuery($_REQUEST);
	$arr = $conn->GetAll($query);
}
for ($i =0,$max=count($arr);$i<$max;$i++){
	$smarty->append('firstName',$arr[$i]['firstName']);
	$smarty->append('lastName',$arr[$i]['lastName']);
	$smarty->append('age',$arr[$i]['age']);
	$smarty->append('street',$arr[$i]['street']);
	$smarty->append('neighborhood',$arr[$i]['neighborhood']);
	$smarty->append('city',$arr[$i]['city']);
	$smarty->append('phone',$arr[$i]['phone']);
	$smarty->append('cellphone',$arr[$i]['phone']);
	if(!empty($arr[$i]['pid'])){
		$smarty->append('id',$arr[$i]['pid']);
	}
	else if (!empty($arr[$i]['id'])){
		$smarty->append('id',$arr[$i]['id']);
	}
}
$ref = "ui/jquery.ui.";
$sd->displayExtFiles(array("base/jquery.ui.all"),false);
$sd->displayExtFiles(array($ref."button",$ref."sortable"),true);
$sd->displayForm("result.tpl");

?>