<?php

class SearchTerms extends Deployment
{
	protected  $conn;
	function __construct()
	{
		parent::__construct();
		$this->table = 'search_queries';
		$this->conn = Utils::giveMeConnection();
	}
	public function Insert() 
	{
		
	}
	/**
	 * (הפונקציה מכניסה ערכים חדשים או עורכת ערכים קיימים בטבלת שאילתות החיפוש )
	 * (עבור משתמשים קיימים)
	 * @see public_html/classes/Deployment::Edit()
	 */
	public function Edit($item)
	{
		global $user;
		if ($user->userid > 0 && $user ){
				unset($_REQUEST['user']);
				unset($_REQUEST['token']);	
		}
		extract($_REQUEST);
		$data = serialize($_REQUEST);
		if (! empty ( $item)){
			$query = "insert into search_queries (pid,data,last) 
				values ($item,'".addslashes($data) ."',NULL) 
					on duplicate key update 
					last=NULL,data = '". $data ."';";
		
			$this->conn->Execute($query);
			return true;
		}
		return;
	}
	public function Delete($item) 
	{
		
	}
	/**
	 * (הפונקציה מקבלת מזהה של משתמש ומחזירה מערך של כל נתוני החיפוש עבור משתמש)
	 * @see public_html/classes/Deployment::SingleView()
	 */
	public function SingleView($item) 
	{
	
		
		$query    = "select * from search_queries where pid = $item";
		$rs = $this->conn->Execute($query);
		$arr = $rs->FetchRow();
		$data = unserialize($arr['data']);
		return $data;
		
		//return Utils::arr2jsonHeb($data);
		
	}
	public function plurelView($item)
	{
		
	}
	public function view($item,$message="")
	{

	}
	/**
	 *  
	 * הפונקציה מציגה על המסך (מאתחלת משתני תצוגה) את כל תיבות הסימון עבור חיפוש
	 * של משתמש אחרי מועמדים רלוונטים 
	 * @param string $candidate_gender  המגדר של המועמד
	 */
	public function show_terms($candidate_gender ="")
	{
		global $smarty;
		global $conn;
		$combos = new Defanitions();
		$r = $conn->GetAll("select * from items where status = 'active' and id in (7,2,3,4,8,6,9)"); //and (gender != '$candidate_gender');");
		$search_data = array();
		foreach($r as $value)
		{
			extract($value);
			$search_data[$var] = $combos->key_value_pair($id);
			if ($gender == $candidate_gender || $gender == 'both'){
				$combos->smarty_set_options($search_data[$var],$var);
			}
			if($gender != $candidate_gender){
				$search_data[$var]['item_view_name'] = $name;
			}
			
			//$search_data[$var]['item_view_gender'] = $gender;
		}
		
		$smarty->assign('search_gender',$candidate_gender);
		$smarty->assign('search_data',$search_data);
	}
	/**
	 * 
	 * הפונקציה בודקת האם קיים חיפוש מועמדים שמור עבור מועמד
	 * @param int $pid
	 */
	public function search_terms_exists($pid)
	{
		if (is_numeric($pid)){
			$query = "select count(*) as num  from search_queries where pid = $pid ";
			$rs = $this->conn->Execute($query);
			$arr = $rs->FetchRow();
			return $arr['num'];
		}else {
			return false;
		}
	}
	
}

?>