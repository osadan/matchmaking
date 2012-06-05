<?php
/**
 * 
 * מחלקה של שכבת הבסיס נתונים 
 * מטפלת בהזנת נתונים ושליפתם עבור כל הפרטים 
 * המרכזיים של מועמד
 * 
 *
 */
class MainDetails extends Deployment 
	{
		private $userid;
		private $def;
		public  $gender;
		function __construct()
		{
			parent::__construct(); 
			$this->table = "person";
			$this->def = new Defanitions();
		}
		/**
		 * (פונקציה שמזינה לטבלה פרטים מרכזיים של מועמד חדש)
		 * @see public_html/classes/Deployment::Insert()
		 */
		public function Insert()
		{
			extract($_REQUEST);
			$query = "insert into shiduchim.person 
			(firstName, lastName, tid, gender, age, dorYesharim, fatherName, fatherJob, fatherWork, motherName, motherLastName, motherJob, sibiling,flow,origin,street,neighborhood,city,country,phone,cellPhone,email,insertDate,updateDate,accupation,s_married,comments,birthdate)
	values
	( '$firstName', '$lastName', '$tid', '$gender', '". myDates::calcAge($age) ."','$dorYesharim', 
		'$fatherName', '$fatherJob', '$fatherWork', '$motherName', '$motherLastName', '$motherJob', 
		'$sibiling', '$flow', '$origin','$street','$neighborhood','$city','$country','$phone',
		'$cellPhone','$email','".date('Y-m-d')."','".date('Y-m-d')."','$accupation','$s_married',
		'$comments','". myDates::fromHebToDb($year,$month,$day) ."');";//select@@IDENTITY
		if ($this->conn->_query($query) === false) {
				Utils::writelog("UpdateQuery:mainDetails:".$query);
				Utils::writelog("Exception:".$this->conn->ErrorMsg());
				print 'error inserting: '.$this->conn->ErrorMsg().'<BR>';
			}
			$person_id =  $this->conn->Insert_ID();
			$this->save_flow_defanition($flow, $person_id);
			$this->save_search_terms($person_id);
			return $person_id;
		}
		
		/**
		 * פונקציה שעורכת פרטים מרכזיים של מועמד קיים
		 * @see public_html/classes/Deployment::Edit()
		 */
		public function Edit($item)
		{
			extract($_REQUEST);
			$query = "update person set firstName='$firstName' ,lastName='$lastName' , tid='$tid',
			gender='$gender',age='" .myDates::calcAge($age)."',birthdate='".myDates::fromHebToDb($year,$month,$day)."',
			dorYesharim='$dorYesharim',fatherName='$fatherName',fatherJob='$fatherJob',
			fatherWork='$fatherWork',motherName='$motherName',motherLastName='$motherLastName',
			motherJob='$motherJob',sibiling='$sibiling',flow='$flow',origin='$origin',street='$street',
			neighborhood='$neighborhood',city='$city',country='$country',phone='$phone',
			cellPhone='$cellPhone',email='$email',updateDate='".date("Y-m-d") ."',
			accupation='$accupation',s_married='$s_married',comments='$comments'
			 where id = ".$item;
			try{
				$rs = $this->conn->Execute($query);
				if($this->conn->Affected_Rows()> 0){
					$this->save_flow_defanition($flow, $item);
					$this->save_search_terms($item);					
					$this->sd->message("השינוי בוצע בהצלחה",true);
				}
				
			}
			catch(Exception $e){
				Utils::writelog("UpdateQuery:mainDetails:".$query);
				Utils::writelog("Exception:".$e->getMessage());
				throw Exception("חלה תקלה במערכת נא להתקשר לאחראי");
			}
		}
		
		/**
		 * פונקציה שמסמנת מועמד כלא ריאלי
		 * @see public_html/classes/Deployment::Delete()
		 */
		public function Delete($item)
		{
			
		}
		public function SingleView($item)
		{
			
		}
		/**
		 * פונקציה שמציגה פרטים מרכזיים של משתמשים עבור שאילתת חיפוש אישית 
		 * @param $item מערך של מספרי מועמדים עבור התנאי של השאילתה
		 * @return מערך נתונים של תוצאות השאילתה 
		 */
		public function plurelView($item)
		{
			if (is_array($item) && count($item) > 0 ){
				$candidates_id = array_values(array_keys($item));
				$query = "select p.id,count(o.`status`) as c_state,firstName , lastName ,age,gender,d.name as flow,origin,accupation,phone,cellphone,comments,street,neighborhood,city
							from person p
							left join defanitions d on p.flow = d.id
							left join offers o on o.boy_id = p.id or o.girl_id = p.id
							where p.id in(" . implode(",",$candidates_id) . ") 
							and  (o.status != 4 or o.status is null) and p.active = 1
							group by p.id
							ORDER BY find_in_set(p.id, '" .implode(",",$candidates_id) . "');";
				
				$candidates = $this->conn->GetAll($query);
				if (is_array($candidates)){
					foreach($candidates as &$candidate)
					{
						if ($candidate['c_state'] > 0 ){
							$query = "select * from offers where boy_id = {$candidate['id']} or girl_id = {$candidate['id']};";
						 	$offers = $this->conn->GetAll($query);
						 	if(is_array ($offers)){
						 		$candidate['offers'] = $offers;
						 	}
						}			
					}
				}	
			return $candidates;
			}
			return array ();
		}
		/**
		 * פונקציה שמדפיסה על המסך נתונים עבור מועמד בודד
		 *@param $item מספר הזיהוי של מועמד
		 * @see public_html/classes/Deployment::view()
		 */
		public function view($item,$message="")
		{
			if(is_numeric($item)){
				$query = "select * from person where id = ".$item ;
				$rs = $this->conn->Execute($query);
				$arr = $rs->FetchRow();
				$arr["age"] = myDates::deCalcAge($arr["age"]);
				$this->gender = $arr['gender'];
				$this->sd->bind($arr);
				$this->sd->ass('main_id',$arr['id']);
				$birthdate  = myDates::fromDbToHeb($arr["birthdate"]);
				$this->sd->bindSelect(array("gender"=>$arr['gender'],"flow"=>$arr['flow'],"year"=>$birthdate["year"],"month"=>$birthdate["month"],"day"=>$birthdate["day"]));
				return;
			}
			else{
				return "";
			}
		}
		
		/**
		 * 
		 * פונקציה ששומרת את הזרם של המועמד בטבלה של פריטי התכונות למועמדים
		 * @param int $flow זרם
		 * @param int $person_id זיהוי חד חד ערכי של מועמד
		 */
		public function save_flow_defanition($flow,$person_id)
		{
			
			if ($flow != ""){ 	
				$this->def->save_defanition_for_query(2, $flow, $person_id);	
			}
			
		}
		/**
		 * 
		 * פונקציה ששומרת ערכים רלוונטים לחיפוש עבור חיפוש עתידי של המועמד
		 * @param int $pid זיהוי חד חד ערכי של מועמד
		 */
		public function save_search_terms($pid)
		{
			extract($_REQUEST);
			$res = $this->conn->Replace('search',
			array ('pid' => $pid,
					"term" => "$dorYesharim $origin $city $phone $cellPhone $accupation" ,
					'name' => "$firstName $lastName",
					'gender' => "$gender" ,
					'age' => myDates::calcAge($age),
					),
			'pid',true
			);
		}
		/**
		 * 
		 * פונקציה שבודקת האם מועמד כבר קיים בטבלאת המועמדים
		 * @param int $pid זיהוי חד חד ערכי של מועמד
		 */
		public function candidate_exist($pid)
		{
			$query = "select count(*) from person where pid = $pid";
			return $this->conn->GetOne($query) > 1;	
		}
		
		public function disable_person($pid)
		{
			$query = 'update person set active = 0 where id = '.$pid;
			$rs = $this->conn->Execute($query);
			return $this->conn->Affected_Rows()> 0;
		}
		public function enable_person($pid)
		{
			$query = 'update person set active = 1 where id = '.$pid;
			$rs = $this->conn->Execute($query);
			return $this->conn->Affected_Rows()> 0;	
		}
	}
?>