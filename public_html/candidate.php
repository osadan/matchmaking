<?
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
require_once('classes/Dates.php');
require_once('classes/QueryGenerator.php');
require_once('classes/Meetings.php');
global $conn;
global $smarty;
$sd = Utils::giveMeSmarty();
$dates = new myDates();
$search_terms = new SearchTerms();
$main_details = new MainDetails();
$gender = null;
$days = null;
$month = null;
$year = null;
$mod = empty($_REQUEST['mod']) ? 'next' : $_REQUEST['mod'] ;
$type = array('Details' => 1,'Look'=>2,'Enviorment'=>3,'Search'=>4);

Utils::trimarr($_REQUEST);
//krumo($_REQUEST);
//show empty form
if(empty($_REQUEST['type'])  && empty($_REQUEST['id']))
{
	Utils::configView(0);
	$open_tab =0;
}
//show form with data
else{
	if (!empty($_REQUEST['id'])){ 
		if(is_numeric($_REQUEST['id'])){
			$pid = $_REQUEST['id'];
			if(!$main_details->checkExist($pid) ){
				header('Location:'.SERVER_ROOT.'candidate_not_found.php');
				exit;
			}
		}else{
			Utils::write_to_log(__FUNCTION__, 'Invalid $_REQUEST[id]', array ('request_id' => $_REQUEST['id']));
			throw  new Exception("Invalid candidate id", $code);
		}
	}else if (empty($_REQUEST['id']) && $_REQUEST['type'] != "Details"){
		header('Location: '.SERVER_ROOT.'candidate_not_found.php');
		exit;
	}
	
	$extrnal_view = new extrnalView();
	$v_inst = new Institutions();
	$v_rel = new Relatives();
	$v_adv = new Advocats();
	$meetings = new Meetings();
	$query_generator = new QueryGenerator();
	
	if($_REQUEST['type'] == "Details"){
		if(empty($pid)){
			$pid = $main_details->insert();
			if ($pid > 0 ){
				$sd->message("נתונים הוזנו בהצלחה",false);
			}
		}else{
			$main_details->Edit($pid);
		}
		$open_tab = 1;
	}
	else if ($_REQUEST['type'] == 'Look'){
		if($extrnal_view->checkExist($pid) === false){
			 $extrnal_view->insert();
		}else{
			$extrnal_view->Edit($pid);
		}
		//$sd->message("הנתונים הוזנו בהצלחה",false);
		$open_tab = 2;
	}
	else if ($_REQUEST['type'] == "Enviorment"){
		$count_adv = $_REQUEST['count_adv'];$count_inst=$_REQUEST['count_inst'];$count_rel= $_REQUEST['count_rel'];
		Utils::InsertList($_REQUEST);
		$sd->message("הנתונים הוזנו בהצלחה",false);
		$open_tab = 3;
	}
	else if ($_REQUEST['type'] == 'search'){
		try{
			$search_terms->Edit($pid);
			$open_tab = 3;
		}
		catch (Exception $ex){
			//@todo handle exception write to log ,show message to the user 
			Utils::writelog("Problem handeling search query");
		}
	}
	else if ($_REQUEST['type'] == 'offers'  || $_REQUEST['type'] == 'meeting'  ){
		$meetings->update_offer_status();
		$sd->message("הנתונים הוזנו בהצלחה",false);
		$open_tab = 4;
	}
	else if ($_REQUEST['type'] == 'show_offers'){
		$open_tab = 4;
	}
	
	// results on first load
	 if ($search_terms->search_terms_exists($pid)){
	 		$search_data = $search_terms->SingleView($pid);
			
	 		if($search_data){
				$candidates_ids = $query_generator->setGenralQuery($search_data);
				$candidates = $main_details->plurelView($candidates_ids);
				$smarty->assign('candidates',$candidates);
				$search_data_json = Utils::arr2jsonHeb($search_data);
				$sd->script .= "search.last_search({".substr($search_data_json,2).",'search-form');";
			}
	}
	//show meetings tab data
	$result = $meetings->get_pending_offers_data($pid);
	$meetings->filter_pending_offers_resutls($result);
	
	
	$main_details->view($pid);
	$gender = $main_details->gender;
	$extrnal_view->view($pid);
	Utils::configView($pid);
	$smarty->assign('act1','edit');
	
	//$smarty->assign('script',$sd->script);
}
if ($mod != 'next'){
		header('Location:index.php');
		exit(0);
	}
//demo
$demo_inst = new Institutions();
$demo_inst->get_all_institutions();
//end demo	
	
$smarty->assign('open_tab',"open_tab = ". ($open_tab ? $open_tab : 0) .";" );
$search_terms->show_terms($gender);
$sd->message_disappear();
$sd->ass('this_jewish_year',$dates->current_jewish_year);
$sd->echohebdate($days,$month,$year);
$sd->displayExtFiles(array("base/jquery.ui.all"),false);
$ref = "ui/jquery.ui.";
$ref_validation = "jquery_validation/";
$sd->displayExtFiles(array($ref."tabs",
							$ref."button",
							$ref_validation.'jquery.validate',
							$ref_validation.'additional-methods',
							$ref_validation.'localization/messages_he',
							$ref.'position',
							$ref.'autocomplete'
							),true);
$sd->displayForm("newPerson.tpl");


?>
