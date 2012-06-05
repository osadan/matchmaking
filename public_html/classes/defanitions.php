<?
/**
 * 
 * פונקציה שמזינה רשימת ערכים עבור סיווג מסוים
 * 
 *
 */
class Defanitions   extends Deployment
{
	
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * הכנסה של ערך חדש לרשימת הערכים
	 * @see public_html/classes/Deployment::Insert()
	 */
	public function Insert()
	{
		extract($_REQUEST);
		$query = "Insert into defanitions(item_id,name) values ($items,'". Utils::UnicodeFix($defanition)  ."')";
		$this->conn->Execute($query);
	}
	
	/**
	 * עריכת ערך קיים מרשימת הערכים
	 * @see public_html/classes/Deployment::Edit()
	 */
    public function Edit($item)
	{
		extract ($_REQUEST);
		if(is_numeric($id)){
			$query = "Update defanitions set name ='". Utils::UnicodeFix($value)  ."' where id =  ". $id;
			Utils::writequery($query);
			$this->conn->Execute($query);
			return $this->conn->Affected_Rows();
		}
		return false;
	}
	
	/**
	 * מחיקת ערך קיים מרשימת הערכים
	 * @see public_html/classes/Deployment::Delete()
	 */
	public function Delete($item)
	{
		$query = "delete from defanitions where id = ".$item;
		//@todo delete or take care of the data in the tables
		if( $this->conn->Execute($query) === false){
			Utils::writequery($conn->ErrorMsg());
			return false;
		}
		return true;
	}
	/**
	 * מילוי תיבת בחירה מרובה בערכים מסוג נתון
	 * @see public_html/classes/Deployment::SingleView()
	 */
	public function SingleView($item)
	{
		$arr = $this->view($item);
		$this->sd->bind($arr[0]);
		$this->sd->bindSelect();
		return ;
	}
	
	/**
	 * החזרת נתונים של רשימת ערכים לפי סיווג נתון
	 * @see public_html/classes/Deployment::plurelView()
	 */
	public function plurelView($item)
	{
		$this->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		
		$query = "select id,name from defanitions"; 
		if ($item != ""){
			$query = $query." where item_id = ".$item ;
		}else {
			$query = $query . " order by id desc";
		}
		return  $this->conn->GetAll($query);
		
	
		
	}
	/**
	 * 
	 * הפונקציה מחזירה מערך של מפתח ערך לפי שם סיווג
	 * @param string $var שם הסיווג 
	 */
	public function singel_item_view($var)
	{
		$query = 'select d.id,d.name from defanitions d';
		if (is_numeric($var)){	
			$query .= " where item_id = $var";
		}else {
			"inner join items i on i.id = d.item_id where i.var = $var";		
		}
		return $this->conn->GetAll($query);
	}
	
	/**
	 * תצוגה של ערך בודד מטבלת רשימת ערכים לפי זיהוי חד חד ערכי
	 * @see public_html/classes/Deployment::view()
	 */
	public function view($item,$message="")
	{
		$query = "select * from  defanitions where id=".$item;
		$arr = $this->conn->GetAll($query);
		return $arr;
	}
	
	/**
	 * 
	 * פונקציה שמקבלת מערך ומחזירה מערך מסוג ג'סון
	 * מיועד לשליחת נתונים לשכבת התצגוה לשימוש בקוד צד לקוח
	 * @param array $result מערך של נתונים מסודרים לפי מפתח ערך
	 * @return string מחרוזת שמייצגת מבנה נתונים בצורת ג'סון
	 */
	public function jsonData($result)
	{
		return "[".substr(Utils::arr2jsonHeb($result),3)."]";
	}
	
	/**
	 * 
	 * הפונקציה מקבלת זיהוי חד חד ערכי של סיווג 
	 * ומחזירה מערך בתצורת מפתח ערך
	 * @param int $item_id זיהוי חד חד ערכי של סוג סיווג
	 */
	public function key_value_pair($item_id)
	{
		$result = $this->plurelView($item_id);
		$options = array();
		foreach ($result as $value)
		{
			$options [$value['id']] = $value['name']; 
		}
		return $options;
	}
	/**
	 * 
	 * פונקציה שמשימה מערכים למשתנים בשכבת התצוגה
	 * על מנת שיוצגו כתיבות בחירה
	 * @param $options מערך עם אפשרויות הבחירה כפי שיובאו מהדאטה בייס
	 * @param $item_smarty_value שם המשתנה של שכבת התצוגה
	 */
	public function smarty_set_options($options,$item_smarty_value)
	{
		global $smarty;
		$smarty->assign($item_smarty_value,$options);
		
	}
	/**
	 * 
	 * הפונקציה מזינה את סוג הזרם של המועמד בטבלת סיווגים למועמד
	 * על מנת לאפשר רישום קל ומהיר וחיפוש קל ומהיר של מועמדים
	 * @param unknown_type $item
	 * @param unknown_type $flow
	 * @param unknown_type $person_id
	 */
	public function save_defanition_for_query($item,$flow,$person_id)
	{
		//@todo give an ability for arrays
		//@TODO preprare and execute
		$query =  "insert into person_defanitions (item_id,user_id,defanition_id) values ($item,$person_id,$flow) on duplicate key update defanition_id=$flow";

		if ($this->conn->_query($query) === false) {
			Utils::writelog("UpdateQuery:mainDetails:".$query);
			Utils::writelog("Exception:".$this->conn->ErrorMsg());
			print 'error inserting: '.$this->conn->ErrorMsg().'<BR>';
		}
	}
	/**
	 * פונקציה שמכניסה או עורכת שורה בטבלת סיווגים למועמד
	 * על מנת לאפשר חיפוש פרטני עבור כל מועמד
	 * @param array $assoc נתונים להזנת התוכן
	 * @param int $person_id מפתח חד חד ערכי של זיהוי המועמד
	 */
	public function save_defanition_for_query_multy($assoc,$person_id)
	{
		$stmt = $this->conn->Prepare('insert into person_defanitions (item_id,user_id,defanition_id) values (?,?,?)
			on duplicate key update defanition_id=?');
		$results = array ();
		foreach ($assoc as $key => $value){
			if ($value != ''){
				$results[] = $this->conn->Execute($stmt,array($key,$person_id ,$value,$value));
			}
		}
	}
}
?>