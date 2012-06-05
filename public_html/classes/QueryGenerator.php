<?php
/**
 * מחלקה שמטפלת ביצירת שאילתות חיפוש 
 * גם עבור חיפוש כללי בכל האתר 
 * וגם עבור חיפוש בתוך כרטיס של מועמד
 *
 */
class QueryGenerator
{
	private $r;
	public $details,$attributes,$conn;
	public $vocab_args,$first_last; 
	public function __construct()
	{ 	
		$this->conn = Utils::giveMeConnection();
		$this->vocab_args = array ('dorYesharim','origin','phone','cellPhone','accupation');
		$this->first_last = array('firstName','lastName');
		krumo::enable();
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function getIndividualQuery()
	{
		extract($r);
		$arr = $this->setGenralQuery($general);
	}
	
	/**
	 * 
	 * ביצוע של שאילתות חיפוש עבור מועמד 
	 * @param $data מערך של פרמטרים של חיפוש
	 * @return מחזיר מערך של זיהוי של מועמדים רלוונטים ממוין לפי פרמטר של כמות ההופעות בשאילתות
 	 */
	public function setGenralQuery($data,$search_all = true)
	{	
		$search_gender = null;
		extract($data);
		$time = time();
		$arr_counter = array ();
		if ($search_all){
			$search_gender = $search_gender == 'male' ? 'female' : 'male' ;
		} 
		if($general != ""){
			$general = trim($general);
			$vars = explode(" ",$general);
			if (count($vars) > 0){
				$pid_name = $this->search_person_name($vars,$search_gender);
				$this->query_results_counter($arr_counter,$pid_name);
			}
			$pid_results = $this->search_terms($general,$search_gender);
			if(count($pid_results) > 0 ){
				$this->query_results_counter($arr_counter,$pid_results);
			}
		}
		if ( !empty($age_from)  || !empty($age_to)){
			$results = $this->search_age($age_from, $age_to, $search_gender);
			$this->query_results_counter($arr_counter,$results);
		}
		
		if (count($def = $this->parse_request($data)) > 0  ){
			$pid_defanitions = $this->search_defanitions($def,$search_gender);
			$this->query_results_counter($arr_counter,$pid_defanitions);
		}
		if($relatives !=""){
			$pid_relatives = $this->search_relatives($relatives);
			$this->query_results_counter($arr_counter,$pid_relatives);		
		}
		if($institutions != ""){
			$pid_institutions = $this->search_institutions($institutions);
			$this->query_results_counter($arr_counter,$pid_institutions);		
		}
		if (is_array($arr_counter)){
			arsort($arr_counter);
			return  $arr_counter;
		}
		return array ();	
	}
	
	/**
	 * 
	 * פונקציה שמאתחלת את המערך של הספירת מופעים של מועמד 
	 * אחרי ביצוע של שאילתת חיפוש
	 * @param array $arr_counter המערך שבו נשמר ערכי הספירה
	 * @param array $arr_source מערך עם תוצאות השאילתה
	 */
	function query_results_counter(&$arr_counter,$arr_source)
	{
		if ($arr_source > 0){
			foreach ($arr_source as $key => $value)
			{
				$arr_counter[$key] += $value;
			}
		}
	}
	/**
	 * 
	 * פונקציה שמחזירה מערך של זיהוי מועמדים לפי חתך של גיל ומגדר
	 * @param int $age_from גיל מ 
	 * @param int $age_to גיל עד
	 * @param string $gender מגדר
	 * @return array מערך עם כל מספרי הזיהוי של המועמדים שענו על הקריטריונים של החיפוש
	 */
	function search_age($age_from,$age_to,$gender)
	{
		global $conn;
		if (!empty($age_from)){
			$from = myDates::calcAge($age_from);
		}
		if (!empty($age_to)){
			$to = myDates::calcAge($age_to);
		}
		$query = "select pid from search where";
		if (!empty($form) && !empty($to)){
			 $query.= "(age between $from and $to || age between $to and $from )";
		}
		else if (!empty($from)){
			$query .= " age <= $from ";
		}else if (!empty($to)){
			$query .= " age >= $to ";
		}
		if (!empty($gender) || $gender != false){
			$query .= " and gender = '$gender'"; 
		}
		$result = $conn->GetAll($query);
		$c = array ();
		if (count($result) > 0 ){
			foreach ($result as $value)
			{
				$c[$value['pid']]++ ;
			}
		}
		return $c;
	}
	
	/**
	 * 
	 * פונקציה שמפשת מועמדים לפי מוסדות לימוד
	 * @param $institutions שם מוסד הלימוד
	 * @return מערך עם כל מספרי הזיהוי של המועמדים שענו על הקריטריונים של החיפוש 
	 */
	function search_institutions ($institutions = "")
	{
		$query = "select pid from institutions where name like '%$institutions%'";
		$result = $this->conn->GetAll($query);
		$pid_institutions = array ();	
		if(count($result) > 0 )
			{
				foreach ($result as $value)
				{
					$pid_institutions[$value['pid']]++;
				}
			}
		return $pid_institutions;	
			
	}
 	/**
 	 * 
 	 * פונקציה שמחפשת מועמדים לפי מחותנים
 	 * @param $relatives שם המחותנים
 	 * @return מערך עם כל מספרי הזיהוי של המועמדים שענו על הקריטריונים של החיפוש
 	 */
	function search_relatives($relatives = "")
	{
		$search = explode(",", $relatives);
		foreach ($search as $value)
		{
			$query = "select pid from relatives where familyName like '%$value%' or flow like '%$value%'" ;
			$result = $this->conn->GetAll($query);
			if(count($result) > 0 )
			{
				foreach ($result as $data_value)
				{
					$pid_relatives[$data_value['pid']]++;
				}
			}		
		}
		return $pid_relatives;
	}
	
	
	
	/**
	 * פונקציה שמחפשת מועמדים לפי הגדרות של מגדר, מראה חיצוני 
	 * וחתך חברתי
	 * 
	 * @param $def הקריטריונים לחיפוש
	 * @param $gender מגדר
	 * @return מערך עם כל מספרי הזיהוי של המועמדים שענו על הקריטריונים של החיפוש
	 */
	function search_defanitions($def,$gender)
	{
		global $conn;
		if (count($def) > 0){
			$query = "select user_id,count(user_id) as count from person_defanitions pd 
					inner join search s on pd.user_id = s.pid
			where defanition_id in (". implode(",",$def) .") and gender = '$gender'
					group by user_id
					order by count desc";
			$result =  $conn->GetAll($query);
			if(count($result) > 0)
			{
				foreach ($result as $value)
				{
					$pid_defanitions[$value['user_id']] = $value['count'];
				}
			}
			return $pid_defanitions;	
		}
		
	}
	/**
	 * 
	 * פונקצית עזר לחיפוש שמקבלת מערך של פרמטרים ומנתחת אותו 
	 * לנתונים שנשלחים לפונקצית החיפוש בתכונות
	 * @return מערך של התכונות הרלונטיות לחיפוש  
	 */
	function parse_request($data)
	{
		if (is_array($data)){
			foreach ($data as $key => $value)
			{
				if (stripos($key,"def_") !== false){
					$def[] = $value;
				}
			}
		}
		return $def;
	}
	/**
	 * 
	 *פונקצית חיפוש עבור שדה של חיפוש חופשי
	 * @param string $general טקסט חופשי
	 * @param string $gender מגדר
	 * @return מערך עם כל מספרי הזיהוי של המועמדים שענו על הקריטריונים של החיפוש
	 */
	function search_terms($general,$gender)
	{
		if(!empty($general)){
			$query = "select pid from search  where term like '%$general%'";  
			if (!empty($gender) || $gender != false){
				$query .= "and gender = '$gender'";
			}
			$query .=$this->setAge();
			$result = Utils::giveMeConnection()->GetAll($query);
			foreach ($result as $value)
			{
				$c[$value['pid']]++ ;
			}
			return $c;
		}
	}
	/**
	 * פונקצית חיפוש עבור שם / שם משפחה של משתמש
	 * @param $value השם לחיפוש
	 * @param $gender מגדר
	 * @return array מערך עם כל מספרי הזיהוי של המועמדים שענו על הקריטריונים של החיפוש;
	 */
	public function search_person_name($vars,$gender)
	{
		if(!empty($vars)){
			foreach ($vars as   $value)
			{
				$query = "select pid from search where name like '%$value%' ";
				if (!empty($gender) || $gender != false){
					$query .= " and gender = '$gender' ";
				}
				
				$query .= $this->setAge();
				$result =  Utils::giveMeConnection()->GetAll($query);
				foreach ($result as $value)
				{
					$c[] = $value['pid'];
				}
				if(count($c) > 0 ){
					foreach ($c as $c_value)
					{
						$pid_name[$c_value]++;
					}
				}
			} 
			
			return $pid_name;
		}
	}
	
	/**
	 * 
	 * פונקציית חיפוש עבור חיפוש כללי באתר 
	 * משתמשת ב $_REQUEST
	 * @return מחזירה את השאילתה כמחרוזת
	 */
	public function getQuery($request)
	{
		$this->r = $request;
		$str = "select *,person.id as pid from  person left join extrnalview on person.id = extrnalview.p_id where 1 = 1 and person.active = 1  " ;
		$query = $this->setAge();
		$query.=$this->setGender();
		$this->setArrays();
		$query.= $this->setConditions($this->details,'comboDetails','inputDetails','condDetails');
 		 $query.= $this->setConditions ($this->attributes ,'comboAttr' , 'comboValueAttr','condAttr');
		 Utils::writequery($str.$query);
		 return  $str.$query;
		 
 		  
	}
	
	/**
	 * 
	 * פונקציה שמנתחת את הבקשה שנשלחת מהדפדפן ומכינה מערכים של נתונים לחיפוש
	 * ממוין לפי תכונות ופרטים
	 */
	public function setArrays()
 	{
 	
 		foreach ($_REQUEST as $key =>$value){
 			preg_match("/Details/",$key,$match);
 			//print_r ($match);echo BR;
 			if(count($match) > 0 ){
 				$this->details [$key] = $value;
 			}	
 			else {
				preg_match("/Attr/",$key,$match);
				if(count($match) > 0 ){
					$this->attributes[$key] = $value;
				} 			
 			}
 		}
 	}
 	
 	/**
 	 * 
 	 * פונקציה שיוצרת תנאים בשאילתה של החיפוש
 	 * @param array $arr מערך שמחזיק את הנתונים
 	 * @param string $combo סוג תיבת הבחירה שממנה נקח את הנתונים
 	 * @param string $val שם הערך
 	 * @param string $cond סוג התנאי (גם \ או )
  	 * @return מחרוזת עם התנאים שנוצרו
 	 */
	public function setConditions($arr,$combo,$val,$cond)
 	{
 		/**
 	 *  setConditions($this->details,'comboDetails','inputDetails','condDetails');
 		setConditions ($this->attributes ,'comboAttr' , 'comboValueAttr','condAttr');
 	* */
 		for ($i = 1,$max = ceil(count($arr) / 3)+1;$i<$max;$i++)
 		{
			$likeArr =  array ("firstName","lastName","fatherName","fatherJob","fatherWodk","motherName","motherLastName","motherJob","origin");
			if($arr[$combo.$i] != "disabled"){	
				if($arr[$val.$i] != ""){
					$fleg = true;
					if($arr[$cond.$i] != "default" and $arr[$cond.$i] != "or" and $arr[$cond.$i] != "" and $str != ""){
						$str .= " and ";
					 }
					else if ($arr[$cond.$i] != "" and $str != "")
 						$str .= " or ";
 					if (! in_array($arr[$combo.$i],$likeArr))
						$str .=  $arr[$combo.$i] ." = '" .$arr[$val.$i]."'";
 					else 
						$str .=  $arr[$combo.$i] ." like '%" .$arr[$val.$i]."%'";
 				} 
			}
 		}
 		if ($fleg){
			$str = "and (".$str.")";
		}
 		return $str;
 	}
 	
 	/**
 	 * 
 	 * פונקציה שמחשבת את התנאי של הגיל
 	 * @return מחרוזת של התנאי שמצטרף לשאילתה הכללית 
 	 */
 	public function setAge()
 	{
 		$from = myDates::calcAge($this->r['age_from']);
 		$to = myDates::calcAge($this->r['age_to']);
 		$str = "";
 		if($from != ""){
			$str = " age <= ".$from;
			$fleg = true;		
 		}
 		if($to != ""){
 			if ($fleg)$str .= " and ";
 			$str .= " age >= ".$to;
		}
		if($str != ""){
			return "and ".$str." ";	
		}
		
 	}
 	
 	/**
 	 * 
 	 * פונקציה שמחזירה תנאי של מגדר המעומדים לחיפוש
 	 * @return מחרוזת של התנאי 
 	 */
 	public function setGender()
 	{
 		$gender = $this->r['gender'];
 		//@@TODO what about boys and girls together like only chasidim 
 		if($gender != "")
 			return " and gender = '". $gender."' ";
	}
}
?>