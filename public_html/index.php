<?php
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
require_once('classes/Dates.php');
global $smarty;
//demo_dates();
	$sd = Utils::giveMeSmarty();
	$action = $_REQUEST['action'];
	if (!empty($action)){
		switch($action)
		{
			case "login":
				$user->login($_REQUEST['loginName'],$_REQUEST['loginPassword']);
			break;	
			case "logout":
				$user->checkOut();
			break;	
			case 'redirect':
				$sd->message("הנך חייב להרשם בכדי להשתמש בתוכנה", true);
			break;
			case 'disable_person':
				$sd->message("המשתמש נמחק בהצלחה");
			break;
		}	
	}
	if ($_REQUEST['auth'] == 'failed'){
		$sd->message("לא נמצאו הרשאות מתאימות למשתמש זה אנא פנה למנהלי האתר", $addTo);
	}
	getLastInserts();
	get_last_assigned_meetings();
	$sd->message_disappear(5000);
	$sd->displayExtFiles(array("base/jquery.ui.all"),false);
	$ref = "ui/jquery.ui.";
	$sd->displayExtFiles(array($ref."button"),true);
	$sd->displayForm("index.tpl");

function getLastInserts()
{
	global $smarty;	
	global $conn;
	//@todo add last instutotion in the query 	
	
	$query = "select * from person where active > 0  order by id desc limit 8";
	$arr = $conn->getAll($query);
	for ($i = 0,$max = count($arr);$i<$max;$i++){
		$smarty->append('firstName',$arr[$i]['firstName']);
		$smarty->append('lastName',$arr[$i]['lastName']);
		$smarty->append('age',myDates::deCalcAge($arr[$i]['age']));
	//	$smarty->append('street',$arr[$i]['street']);
	//	$smarty->append('neighborhood',$arr[$i]['neighborhood']);
	//	$smarty->append('city',$arr[$i]['city']);
		$smarty->append('phone',$arr[$i]['phone']);
		$smarty->append('cellphone',$arr[$i]['phone']);
		$smarty->append('id',$arr[$i]['id']);
	}
	
}

function get_last_assigned_meetings()
{
	global $conn;
	global $smarty;
	$query = " select m.max_m as meeting,
				concat(p1.firstName,' ',p1.lastName) as girl,
				concat(p2.firstName,' ',p2.lastName) as boy,
                p1.id as girl_id,
                p2.id as boy_id,
                mt.meeting_date_real,
                o.status_boy as status_boy_id,o.status_girl as status_girl_id,
                (select name from defanitions where id = o.status_boy) as status_boy,
                (select name from defanitions where id = o2.status_girl) as status_girl
							from person p2,person p1 ,offers o ,offers o2,
	            			(select max(m_id) as max_m ,offer_id  from meetings group by offer_id) m
                    inner join meetings as mt on m.max_m = mt.m_id
	            			where p1.gender = 'female' and p2.gender = 'male'
				            and p1.id = o.girl_id and p2.id = o.boy_id
				            and o.o_id = o2.o_id and o.status = 'meeting' and o2.status = 'meeting'
				            and p1.active = 1 and p2.active = 1
				            and m.offer_id  = o.o_id and m.offer_id = o2.o_id order by m.max_m desc limit 8 ";
	$arr = $conn->getAll($query);
	$smarty->assign('last_meetings',$arr);
}

function demo_dates()
{
	$year = date('Y');
	$time = time();
	//$heb_year = gregoriantojd(1,1,$year);
	//krumo (myDates::year(-3,2));
	//krumo (myDates::year(10,50));
	//	krumo(jdtojewish(unixtojd($time),true));
	//$jdtounix = jdtounix(jewishtojd ( 1 , 4 , 5739 ));
	//$birthdaty  = date('Y-m-d',$jdtounix);
	//krumo($birthday);
	$heb_date = jdtojewish(gregoriantojd(date('m'),date('d'),date('Y')));
	$date = explode('/',$heb_date);
	$gregorianMonth = date(n);
	$gregorianDay = date(j);
	$gregorianYear = date(Y);

	$jdDate = gregoriantojd($gregorianMonth,$gregorianDay,$gregorianYear);

	$hebrewMonthName = jdmonthname($jdDate,4);

	$hebrewDate = jdtojewish($jdDate);

	list($hebrewMonth, $hebrewDay, $hebrewYear) = explode('/',$hebrewDate);
	
	
}
function showMultyViewDetails($id)
{
	$inst = new Institutions();
	$inst->view($id,'done');
}
function demoDoubleDollar()
{
	$var1 = "a";
	$var2 ="b";
	//$name = "var";
	$ohad = "sadan";
	$$ohad = "stock";
	echo $sadan;
	for($i=1;$i<3;$i++)
	{
		//echo $var1;
		$name = "var".$i;
		echo $$name;
	}
}
?>