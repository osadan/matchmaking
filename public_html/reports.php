<?php
session_start();
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
include_once('libs/adodb5/adodb-pager.inc.php');
require_once('classes/Dates.php');
$user->check_user_premmisions(255);
global $conn;
global $smarty;
$sd = new smartyDisplay($smarty);
$grid_header = "";
if (isset($_REQUEST['select_report']) && $_REQUEST['select_report'] != 'null'){
switch ($_REQUEST['select_report']){
	case '0':
		//@todo add validation that date from is no bigger then date to  
			$query = "select concat('<a href=\"".SERVER_ROOT."candidate.php?id=',id,'\">הצג</a>') as '', 
							firstName as 'שם פרטי',
							lastName as 'שם משפחה',
							phone as 'טלפון',
							year(curdate()) - age as 'גיל'
						from person where insertDate between '{$_REQUEST['date_from']}' and '{$_REQUEST['date_to']}'";
			//
		$grid_header = 'תצוגת מועמדים אחרונים';			
		break;
	case '1':
			$query_not_that_afficent = "select s.o_id,m_id,p1.firstName as girl_first_name,p1.lastName as girl_last_name,
				p2.firstName as boy_first_name,p2.lastName as boy_last_name
						from person p1 ,person p2 ,offers as s
						inner join (select *  from meetings order by m_id desc) as m  on m.offer_id = s.o_id
						where p1.id in (select girl_id from offers o where s.o_id = o.o_id and status = 'meeting' )
						and p2.id in (select boy_id from offers o where s.o_id = o.o_id and status = 'meeting')
						and p1.gender = 'female' and p2.gender = 'male'
						group by o_id
						order by m_id desc ";
				$query = " select 
								m.max_m as פגישה,
								concat(p1.firstName,' ',p1.lastName) as בנות,
								concat(p2.firstName,' ',p2.lastName) as בנים
							from person p2,person p1 ,offers o ,offers o2,
	            			(select max(m_id) as max_m ,offer_id  from meetings group by offer_id) m
	            			where p1.gender = 'female' and p2.gender = 'male'
				            and p1.id = o.girl_id and p2.id = o.boy_id
				            and o.o_id = o2.o_id and o.status = 'meeting' and o2.status = 'meeting'
				            and m.offer_id  = o.o_id and m.offer_id = o2.o_id order by m.max_m desc";
			
			$grid_header = 'פגישות קרובות';
			
	 break;
	case '2' :
		$query = 'select 
				o_id as זיהוי,
				concat(p1.firstName,\' \',p1.lastName) as בנות,
				concat(p2.firstName,\' \',p2.lastName) as בנים
				from person p1 ,person p2 ,offers as s
				where
				p1.id in  (select girl_id from offers o where s.o_id = o.o_id and status = \'MazalTov\' )
				and
				p2.id in  (select boy_id from offers o where s.o_id = o.o_id and status = \'MazalTov\')
				and update_date between \'' .$_REQUEST['date_from'] . '\' and \'' . $_REQUEST['date_to'] . '\'	
				 and p1.gender = \'female\' and p2.gender = \'male\'
			';
		$grid_header = 'וורטים שנסגרו';
	break;
	case null:
	default:
	break;	
	}
	
	$pager = new ADODB_Pager($conn, $query,'adodb',true);
	$pager->page = 'עמוד';
	$pager->linkSelectedColor = '#eeeeee';
	$pager->gridAttributes = 'class="shid-result-table sortable"';
	$pager->htmlSpecialChars = false;
	//$pager->gridHeader = $grid_header;
	ob_start(); 
		$pager->Render($rows_per_page = 20);
		$table = ob_get_contents();
	ob_end_clean();
	$smarty->assign('grid_header',$grid_header);
}	
$smarty->assign ('date_from',$_REQUEST['date_from']);
$smarty->assign('date_to',$_REQUEST['date_to']);
$smarty->assign('selected',$_REQUEST['select_report']);
$smarty->assign('table',$table);
$sd->displayExtFiles(array("base/jquery.ui.all"),false);
$ref = "ui/jquery.ui.";
$sd->displayExtFiles(array('sorttable',$ref."datepicker",$ref."button"),true);
$sd->displayForm("reports.tpl");
