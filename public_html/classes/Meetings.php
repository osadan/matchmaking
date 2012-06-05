<?php
/**
 * 
 * אובייקט שמטפל בכל הנושא של פגישות והצעות
 * 
 *
 */
class meetings
{
	private $conn;
	private $offers_status_item_id;
	public $offer_statuses;	
	public $on_meetings;
	public $on_offers;
	public $on_refused;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
		$this->offers_status_item_id = 21;
		$this->meeting_stauts_item_id = 22; 
		$this->offer_statuses = array(
			'offer' => 'הצעה',
			'meeting' => 'בפגישות',
			'refused' => 'נדחה',
			'mazalTov' => 'מזל טוב',
		);
		 
	}
	
	function get_last_meetings()
	{
		$query = "select 
					m.max_m as m_id,o.o_id as o_id,o.status_boy,o.status_girl,
					concat(p1.firstName,' ',p1.lastName) as girls_name,
					concat(p2.firstName,' ',p2.lastName) as boys_name
				from person p2,person p1 ,offers o ,offers o2,
            	(select max(m_id) as max_m ,offer_id  from meetings group by offer_id) m
            	where p1.gender = 'female' and p2.gender = 'male'
	            and p1.id = o.girl_id and p2.id = o.boy_id
	            and o.o_id = o2.o_id and o.status = 'meeting' and o2.status = 'meeting'
	            and m.offer_id  = o.o_id and m.offer_id = o2.o_id";

	}
	/**
	 * 
	 * פונקציה שמעדכנת או יוצרת פגישה בטבלה 
	 * @return את המספר שורה של השורה בטבלה 
	 */
	function save_new_meeting()
	{
		$post = Utils::iconv_post();
		
		$params['meeting_updated'] = Utils::mysql_now();
		$params['meeting_date'] =serialize(array ('time'=> $post['time'],'days' => $post['days'],'month' => $post['month'] ,'years' => $post['years']));
		$params['meeting_date_real'] = myDates::fromHebToDb($post['years'],$post['month'],$post['days']);
		
		$params['meeting_place'] =$post['meeting_place']; 
		$params['remarks'] = $post['remarks']; 
		$params['offer_id'] =$post['offer_id'];
		if (empty($post['m_id'])){
			$params['meeting_created'] = Utils::mysql_now();
			
		}else{
			$params['m_id'] = $post['m_id'];
		}
		$res = $this->conn->Replace('meetings',$params,'m_id',true);
		switch($res){
			case 0:
			default: 
				return 0;
			break;	
			case 1:
				$dates =  myDates::unserialize_date_time_field($params['meeting_date']);
				$text = "עודכנה פגישה".BR. " מיקום:".$params['meeting_place'].BR.'זמן: '.$dates['date_string']. '-'.$dates['time_string'];  
				$this->insert_offer_remarks($text,$params['offer_id']);	
				return $params['m_id'];
			break;
			case 2:
				$dates =  myDates::unserialize_date_time_field($params['meeting_date']);
				$text = "הוכנסה פגישה חדשה ".BR. " מיקום:".$params['meeting_place'].BR.'זמן: '.$dates['date_string']. '-'.$dates['time_string'];  
				$this->insert_offer_remarks($text,$params['offer_id']);
				return $this->conn->Insert_ID();
			break;		
		}
		return 0;	
	}
	
	/**
	 * 
	 * פונקציה שמוחקת פגישה בטבלה
	 * @param $m_id מספר הפגישה למחיקה
	 * @return 'אם המחיקה הצליחה מחזירה 1 אם לא מחזירה 'נכשל;
	 */
	function remove_meeting($m_id)
	{
		if (is_numeric($m_id)){
			$text = "הוסרה פגישה".BR. " מיקום:".$params['meeting_place'].BR.'זמן: '.$dates['date_string']. '-'.$dates['time_string'];  
			$this->insert_offer_remarks($text,$params['offer_id']);
			$this->conn->Execute('delete from meetings where m_id ='.$m_id);
			return $this->conn->Affected_Rows();
			
			}
		return false;
	}
	/**
	 * פונקצית חזרה לבקשה אסינכרונית מהשרת 
	 * להוספת הצעה חדשה בטבלה
	 * @param $boy_id מספר מועמד של הזכר
	 * @param $girl_id מספר המועמד של הנקבה
	 * @return מחזיר את הסטטוס של השאילתה
	 */
	function add_new_offer($boy_id,$girl_id)
	{
		if (is_numeric($boy_id) && is_numeric($girl_id)){
			try{
			$now = 	Utils::mysql_now();
			$res = $this->conn->Replace('offers',array(
				'status' => 'offer',
				'boy_id' => $boy_id,
				'girl_id' => $girl_id,
				'update_date' => $now,
				'insert_date' => $now,
				'status_boy' => '0',
				'status_girl' => '0'
			),'o_id',true);
			return array ('result' => $res);
			}catch(Exception $ex){
				Utils::writequery(__FUNCTION__."\n\rQuery:{$ex->sql}");
				if (stripos($ex->msg, 'Duplicate') == 0){
					return array ('result' => 'duplicate');
				}else{
					return array ('result' => $ex->msg);
				}
			}
		}else{
			Utils::write_to_log(__FUNCTION__, 'Not Valid Input', $_REQUEST);
			return array ('result' => 'error');
		}
	}
	
	/**
	 * פונקציה שמעדכנת את הסטטוס וההיסטוריה של הצעה 
	 * משתמשת במשתנה הבקשה בשביל קבלת הנתונים
	 * 
	 */
	function update_offer_status()
	{
		extract($_REQUEST);
		$query = "select * from offers where o_id = $offer_id limit 1";
		$defanitions = new Defanitions();
		$status_item_id = $this->get_status_item_id($offer_status);
		$offer_status_options = $defanitions->singel_item_view($status_item_id);
		$offer_status_array = array( '0' => 'בחר');
		foreach ($offer_status_options as $value)
		{
			$offer_status_array[$value['id']] = $value['name'];	
		}
		
		
		$row = $this->conn->GetRow($query);
		$params = array ();
		if ($row['status'] != $offer_status){
			$add_on [] = 'השתנה סטטוס הצעה מ  - ' ;
			$add_on [] = $this->offer_statuses[$row['status']]; 
			$add_on [] = ' ל -  ';
			$add_on [] = $this->offer_statuses[$offer_status];
			$add_on [] = BR; 
 			$params['status'] = $offer_status ;
			$params['status_boy']  = 0;
			$params['status_girl'] = 0;
			
		}
		else{
			if($row['status_boy'] != $boy_offer_status){
				$add_on [] = 'השתנה ססטוס בן מ  -  ';
				$add_on [] = $offer_status_array[$row['status_boy']]; 
				$add_on [] = ' ל - ';
				$add_on [] = $offer_status_array[$boy_offer_status];
				$add_on [] = BR; 
				$params['status_boy'] = $boy_offer_status;
			}
			if($row['status_girl'] != $girl_offer_status){
				$add_on []= 'השתנה ססטוס בת מ - ';
				$add_on [] = $offer_status_array[$row['status_girl']]; 
				$add_on [] = ' ל - ';
				$add_on [] = $offer_status_array[$girl_offer_status];
				$add_on [] = BR;  
	 			
				$params['status_girl'] = $girl_offer_status;
			}
		}
		if(count($params) > 0 ){
			$params['o_id'] = $offer_id;
			$params['update_date'] = Utils::mysql_now();
			try
			{
				$res = $this->conn->Replace('offers',$params,'o_id',true);
				$offer_remarks = implode('',$add_on).( $offer_remarks ? 'הערות'.BR.$offer_remarks : '' ) ;
			}
			catch(Exception $ex){
				Utils::writequery(__FUNCTION__."\n\rQuery:{$ex->sql}");
				return false;
			}
		}
		if(!empty($offer_remarks)){
			$this->insert_offer_remarks($offer_remarks,$offer_id);
		}		
		if ($row['status'] =='MazalTov'){
			$query = "update person set active = 0 where id ={$row['boy_id']} or id = {$row['girl_id']} ";
			$this->conn->Execute($query); 
		}
		return $res;
	}
	
	/**
	 * 
	 * פונקציה שמכניסה הערות לטבלת הערות להצעה
	 * @param $remarks ההערות
	 * @param $offer_id מספר ההצעה
	 * @return אינדיקציה לגבי הצלחת הפעולה
	 */
	function insert_offer_remarks($remarks,$offer_id)
	{
		$now = 	Utils::mysql_now();
		$params = array ();
		$params['offer_id'] =  $offer_id;
		$params['text'] = $remarks;
		$params['insert_date'] = $now;
		$params['update_date'] = $now;
		try{
			$result = $this->conn->Replace('offers_remarks',$params,'r_id',true);
			return $result;
		}catch (Exception $ex){
			Utils::writequery(__FUNCTION__."\n\rQuery:{$ex->sql}");
			return false;
		}
	}
	
	/**
	 * 
	 * פונקציה שמציגה היסטוריה של הצעה
	 * @param $offer_id מספר ההצעה
	 * @return פלט תצוגה של הנתונים
	 */
	function generate_offer_history($offer_id)
	{
		$query = "select * from offers_remarks  where offer_id = $offer_id order by update_date desc;";
		$result = $this->conn->GetAll($query);
		$output = "";
		foreach($result as $value)
		{
			
			//krumo($value['update_date'],myDates::fromDbToHeb2($value['update_date']));
			$output .= '<h5>'.myDates::fromDbToHeb2($value['update_date']) .', '. myDates::timeFormat($value['update_date']) . "</h5>";
			$output .= '<p>'.$value['text']."<p />";
		}
		return $output;
		
	}
	
	/**
	 * 
	 * פונקציה שמחזירה את כל המועמדים שרשומים להצעה
	 * עבור מועמד ספציפי
	 * @param int $person_id מספר זיהוי  שורה של המועמד
	 * @return מערך של תוצאות השאילתה
	 */
	function get_pending_offers_data($person_id)
	{
		if (is_numeric($person_id)){
			try{
			$query = "select p.id,firstName,lastName ,age,gender,d.name as flow,origin,accupation,phone,cellphone,comments,street,neighborhood,city,o.* 
					from person p
					left join defanitions d on p.flow = d.id
					inner join offers o on o.boy_id = p.id or o.girl_id = p.id
					where p.id in (
					select
					if (p.gender = 'male',girl_id,boy_id)
					from offers o
					inner join person p on o.boy_id = p.id or o.girl_id = p.id
					where p.id = {$person_id} and status != 'MazalTov'
					)
					and (o.boy_id = {$person_id} or o.girl_id = {$person_id})
					and p.active = 1 
					order by o.status ,o.update_date desc;";
				
				return $this->conn->GetAll($query);
			}
			catch (Exception $ex){
				Utils::writequery($query);
				return array();	
			}
		}	
		else{		
			Utils::write_to_log(__FUNCTION__, "Person Id Is not Valid", array('person_id' => $person_id));
		}
	}
	
	/**
	 * 
	 * פונקציה שממינת את תוצאות השאילתה של המועמדים שמוצעים 
	 * למועמד ספציפי הפונקציה רושמת את הנתונים לפרמטרים משכבת התצוגה
	 * @param $data תוצאות של השאילתה של המועמדים המוצעים למועמד
	 */
	function filter_pending_offers_resutls($data)
	{
		global $smarty;
		$this->on_meetings = array();
		$this->on_offers = array();
		$this->on_refused = array();
		if(is_array($data)){
			foreach($data as $candidate)
			{
				$candidate['log'] = $this->generate_offer_history($candidate['o_id']);
				switch($candidate['status'])
				{
					case 'meeting':
						$candidate['meetings']= $this->get_offer_meeting_data($candidate['o_id']);
						$candidate['meeting_number'] = $this->get_meeting_number($candidate['o_id']);
					 	$this->on_meetings[] = $candidate;
						break;
					case 'refused':
						$this->on_refused[] = $candidate;
						break;
					case 'offer':
						$this->on_offers [] = $candidate;
					break;			
				}
			}
		}
		$smarty->assign('on_meetings',$this->on_meetings);
		$smarty->assign('on_refused',$this->on_refused);
		$smarty->assign('on_offers',$this->on_offers);
	}
	
	/**
	 * פונקציה שיוצרת תיבת בחירה מרובה עבור סטטוסים בהצעה
	 * הפונקציה נקראת משכבת התצוגה
	 * @param $selected_id הערך הנבחר בתיבת הבחירה המרובה
	 * @param $type סוג הסטטוס המבוקש
	 * @return מחרוזת של האופציות עבור תיבת הבחירה המרובה
	 */
	function set_offer_status_combo($selected_id,$type)
	{
		
		$defanitions = new Defanitions();
		$status_item_id = $this->get_status_item_id($type);
		$status = $defanitions->singel_item_view($status_item_id);
		foreach ($status as  $value)
		{
			$str .= "<option value='{$value['id']}'";
				if ($value['id'] == $selected_id){
					$str .= "selected='selected'";
				}
			$str .= ">{$value['name']}</option>";
		}
		return $str;
	}
	
	/**
	 * 
	 * פונקציה שמחזירה מפתח של מספר פריט לפי סוג
	 * @param $type הסוג שממנו נקח את המפתח 
	 */
	function get_status_item_id($type)
	{
		switch ($type){
			case 'offers':
				$status_item_id = $this->offers_status_item_id;
			break;
			case 'meeting':
				$status_item_id = $this->meeting_stauts_item_id;
			break;	
		}
		return $status_item_id;
	}
	/**
	 * 
	 * פונקציה שמחזירה את כל הפגישות עבור הצעה
	 * @param $offer_id מספר הצעה
	 * @return מערך של נתונים
	 */
	function get_offer_meeting_data($offer_id)
	{
		if (is_numeric($offer_id)){
			$query = "select * from meetings where offer_id ={$offer_id} order by meeting_updated desc";
			$result = $this->conn->GetAll($query);
			return $result;
		}
		return false;
	}
	/**
	 * 
	 * פונקציה שמחזירה כמה פגישות יש להצעה
	 * @param $offer_id מספר הצעה
	 * @return מספר הפגישות
	 */
	function get_meeting_number($offer_id)
	{
		if(is_numeric($offer_id)){
			$meeting_number_query = "select count(*)as num from meetings where offer_id ={$offer_id}";
			$meeting_number = $this->conn->GetOne($meeting_number_query);
			return $meeting_number;
		}
		return 0;
	}
	
}