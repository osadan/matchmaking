<?php

/**
 * 
 * אובייקט שמטפל במשתנים שנשלחים משיכבת הלוגיקה לשיכבת התצוגה
 * @author אהד סדן	 
 *
 */
class smartyDisplay
{
	private  $smarty;
	public $script;
	function __construct($obj)
	{
		$this->smarty = $obj;
		$this->script = "";
	}
	/**
	 * פונקציה שמציגה קבצי סטייל וקבצי ג'אוהסקריפט 
	 * בצורה דינאמית 
	 *
	 * @param array $arr שמות הקבצים 
	 * @param bool $type סוג הקובץ ג'אווהסקריפט או סטייל 
	 */
	function displayExtFiles($arr ,$type="")
	{
		global $smarty;
		$str = "";
		if($arr){
			foreach($arr as $value)
			{
				if($type){				
					$str .= "<script type='text/javascript' src='". SERVER_ROOT ."scripts/$value.js'></script>";
				}
				else{
					$str .= "<link rel='stylesheet' href='". SERVER_ROOT ."css/$value.css'' type='text/css' media='screen' />";
				}
			}
		}
		$type ? $smarty->assign('js',$str):$smarty->assign('css',$str);
	}
	/**
	 * 
	 * פונקציה שמציגה קובץ משיכבת התצוגה בתוך הקובת הכולל של האתר
	 * וגם את האובייקט יוזר
	 * @param $form אם חיובי אז אנחנו מתייחסים לתבנית המרכזית באתר
	 */
	function displayForm($form="")
	{
		global $smarty,$user;
		
		$smarty->assign("user",$user);
		if($form){
			$content = $smarty->fetch($form);
			$smarty->assign('content',$content);
		}
		//echo $_SERVER['PHP_SELF'];
		$this->ass("script",$this->script);
		$smarty->display('page.tpl');
	
	}
	/**
	 * 
	 * מאפשר להציג הודעת צד לקוח באזור ההודעות למשתמש מצד שרת
	 * @param $msg הודעה ללקוח
	 * @param $addTo האם למחוק את ההודעה לאחר פרק זמן
	 */
	function message($msg,$addTo = 0)
	{
		$this->smarty->assign('message',$msg);
		$addTo = $addTo == true ? 2000 : $addTo ;
		if ($addTo > 0 ){
			$this->message_disappear($addTo);
		}
		
	}
	/**
	 * 
	 * מוסיף פונקציה צד שרת שמסירה את ההודעה אחרי זמן נתון
	 */
	function message_disappear($time = 2500)
	{
		$this->script .="setTimeout(delmsg,$time);";
	}
	
	/**
	 * 
	 * פונקציה שמוסיפה פונקציות צד שרת לשכבת הפרזנטציה
	 * @param $script פונקצית צד השרת
	 */
	function add_script($script)
	{
		$this->script .=$script.'\n';
	}
	/**
	 * 
	 * פונקציה שמאתחלת משתנה פרזנטציה עם ערך צד שרת
	 * @param $key משתנה פרזנטציה
	 * @param $val ערך צד שרת 
	 */
	function ass($key,$val)
	{
		$this->smarty->assign($key,$val);
	}
	/**
	 * 
	 * פונקציה שמקבלת מערך ומאתחלת משתנה פרזנטציה 
	 * בפונקציה שמקבלת את המערך כאובייקט ג'סון על מנת למלאות אובייקט
	 * של תיבת בחירה 
	 * @param $arr מערך משכבת הנתונים
	 * 
	 */
	function bindSelect($arr)
	{
		$json = "var Rows = [";
		foreach($arr as $key=>$value)
		{
			$json .= "{'id':'".$key."','selected':'".$value."'},";
		}
		$json = substr($json,0,strlen($json)-1);
		$json.= "];";
		$this->script .= $json."bindSelect(Rows);\n";
		
	}
	/**
	 * 
	 * פונקציה שמקבלת מערך ומאתחלת משתנה פרזנטציה בפונקצית צד לקוח
	 * שמקבלת מערך מטיפוס אובייקט ג'סון ומאתחלת משתנים מסוג תיבות סימון
	 * @param $arr מערך משכבת הנתונים
	 */
	function bindCheckbox($arr)
	{
		$json = "var Rows = [  ";
		foreach($arr as $key=>$value)
		{
			if ($value > 0)
			{
				$json .="{'id':'".$key."'},";
			}
		}
		$json = substr($json,0,strlen($json)-1);
		$json .="];";
		//echo $json;
		$this->script .= $json."bindCheckbox(Rows);";
	}
	/**
	 * 
	 * פונקציה שמקבלת מערך מסוג מפתח ערך ומאתחלת
	 * משתני פרזנטציה בהתאם 
	 * @param $arr מערך משכבת התצוגה
	 */
	function bind($arr)
	{
		foreach($arr as $key=>$value)
		{
			$this->ass($key,$value);
		}
	}
	
	/**
	 * 
	 * פונקציה שמקבלת מערך מסוג מפתח-ערך ומאתחלת 
	 * משתנה פרזנטציה לפי אינקס נתון
	 * @param $arr מערך משכבת הנתונים
	 * @param $index אינדקס נתון
	 */
	function bindMulty($arr,$index)
	{
		foreach($arr as $key=>$value)
		{
			$this->ass($key.$i,$value);
		}
	}
	/**
	 * 
	 * פונקציה שמוסיפה ערכים למערך פרזנטציה קיים
	 * וממזגת את הערכים במקרה ויש כבר מערך קיים
	 * @param $name שם המערך בשכבת התצוגה
	 * @param $arr המערך להוספה
	 */
	function append($name,$arr)
	{
		$this->smarty->append ($name,$arr);
	}
	/**
	 * 
	 * פונקציה שמאתחלת את שכבת התצוגה בשלוש תיבות בחירה מסוג
	 * תאריך עברי
	 * @param $days מערך שמציג ימים
	 * @param $month מערך שמציג חודשים
	 * @param $year מערך שמציג שנים
	 */
	function echohebdate($days,$month,$year)
	{
		$this->ass('days',myDates::days());
		$this->ass('month',myDates::month());
		$this->ass('year',myDates::year(10,50));
	}
}
class Utils
{
	private static $location = "../files/log/";
	private static $connFleg = false;
	private static $smarty_fleg = false;
	private static $mydates_fleg = false;
	private static $conn;
	private static $sd;
	private static $mydates;
	private static $premmisons = array(256=>"מנהל",128=>"עורך",64=>"חיפוש מלא",32=>"חיפוש מוגבל");
	public static function UnicodeFix($value)
	{
		return iconv("UTF-8","Windows-1255",$value);
	}
	public static function iconv_post()
	{
		foreach($_POST as $key => $value)
		{
			$temp[$key] = Utils::UnicodeFix($value);
		}
		return $temp;
	}
	public static function getPremmisonByNum($key)
	{
		return self::$premmisons[$key];
	}
	public static function giveMeConnection()
	{
		//echo 'A';
		//@TODO check if the condition really works
		//var_dump(self::$connFleg);
		if(!self::$connFleg){
			///echo 'B';
			try {
				self::$conn = ADONewConnection(DBDRIVER);
				//self::$conn->debug  = DEBUG;
				self::$conn->Connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
				//self::$conn->LogSQL();
				self::$conn->_query('SET names "hebrew"');
				self::$conn->SetFetchMode(ADODB_FETCH_ASSOC);
				self::$connFleg = true;
			}catch(Exception $ex) {
				throw $ex;
			}
			//var_dump(self::$conn);
		}
		return self::$conn;
	}
	
	public static function giveMeSmarty()
	{
		if(!self::$smarty_fleg){
			global $smarty;
			self::$sd = new smartyDisplay($smarty);
			self::$smarty_fleg = true;
		}
		return self::$sd;
	}
	
	public static function giveMeMyDates()
	{
		if(!self::$mydates_fleg){
			self::$mydates = new myDates();
			self::$mydates_fleg = true;
		}
		return self::$mydates;
	}
	
	
	public static function mysql_now(){
		return date('Y-m-d H:i:s',time());
	}
	public static function add_zero_for_single_number($number)
	{
		if ($number > 10 ){
			return '0'.$number;
		}
		return $number;
	}
	public static function arr2jsonHeb($arr)
	{
		$str .= ",{" ;
		if (is_array($arr)){
			foreach ($arr as $key => $value)
			{
				if(is_array($value)){
					$str .= Utils::arr2jsonHeb($value);
				}else{
					$str .= "'".addslashes($key)."':'".addslashes($value) ."',";
				}
			}
			//remove last cooma
			//
		}
		//$str = substr($str,1,strlen($str)-1).'}';
		$str = substr($str,0,-1); 
		$str = $str .'}';
		return $str;
	}
	
	public static function generate_select_box($values,$class,$label,$name,$id,$selected = null)
	{
		$output = "<div class='{$class}'>
					<label>{$label}:</label>
					<select name='{$name}' id='{$id}'>";
		foreach ($values as $k => $v)
		{
			$output .= "<option value='{$k}'";
			if ($selected == $k){
				$output .= "selected='selected'";
			}
			$output .=">{$v}</option>";
			
		}
		$output.="</select></div> ";
		return $output;
	}
	public static function trimarr(&$arr)
	{
		//print_r($arr);
		
		foreach($arr as $key => $value)
		{	
			$arr[$key] = trim($value);
		}
		//return $arr;
	}
	public static function writelog($msg)
	{
		//echo "before";
		$logfile = self::$location."log.txt";
		self::writefile($logfile,$msg);
	}
	/**
	 * 
	 * Write data in log file
	 * @param string $function 
	 * @param string $message
	 * @param array $params
	 */
	
	public static function write_to_log($function,$message,$params)
	{
			$str  = "Function : $function \n\r Message : $message \n\r Params : ";
			if (is_array($params)){
				foreach ($params as $key =>$value)
				{
					$str .= "$key = $value \n\r";
				}
			}
			Utils::writelog($str);
	}
	public static function writequery($msg)
	{
		$queryfile = self::$location."query.txt";
		self::writefile($queryfile,$msg);
	}
	public static function writefile($file,$msg)
	{
		$text = file_get_contents($file);
		$text .= date(DATE_RFC822)." ".$msg."\r\n";
		file_put_contents($file,$text);
	}
	public static function configView($id=0)
	{
		$v_inst = new Institutions();
		$v_rel = new Relatives();
		$v_adv = new Advocats();
		if (is_numeric($id) && $id > 0){
			$v_inst->plurelView($id);
			$v_rel->plurelView($id);
			$v_adv->plurelView($id);
		}
	}
	public static function InsertList($req)
	{
		$adv = new AdvocatsList();
		$inst = new InstitutionsList();
		$rel = new RelativesList();
		$inst->insertList($req);
		$adv->insertList($req);
		$rel->insertList($req);
	}
}
class  ActiveUser
{
	public $name,$premmisions,$nickName,$token,$user_id;
	/**
	 * פונקציה שמבצעת יציאה של יוזר מהאתר
	 * 
	 */
	function checkout()
	{
		global $conn;
		global $user;
		$conn->_query("delete from login where userid=".$_COOKIE['user']);
		setcookie('user',"",-3600);
		setcookie('token',"",-3600);
		$user = false;
		//return $this;
	}
	
	/**
	 * 
	 * הפונקציה בודקת אם פרטי המשתמש נכונים כאשר מתבצעת 
	 * כניסת משתמש
	 * @param $name -> שם המשתמש
	 * @param $pass -> סיסמה
	 * @return boolean -> אמת אם בוצע לוגין ושקר אם לא בוצע לוגין
	 */
	function login($name,$pass)
	{
		global $conn;
		$sd = Utils::giveMeSmarty();
		$query = "select * from users where nickName = '$name' and password = '". md5($pass)."' limit 1;";
		$res =$conn->Execute($query);
		if($res->RecordCount( ) > 0){
			$login = $res->FetchRow();
			if ($login){
					$this->name = $login['firstName']." ".$login['lastName'];
					$this->premmisions = $login["premmisions"];
					$this->nickName = $login["nickName"];
					$this->token = $login['random'];
					$this->userid = $login["id"];
					$this->writeLoggedUser();
					$sd->message(' שלום ' . $this->name . ' ' . ' נרשמת בהצלחה לאתר' ,false);
					return true;
			}else{
				Utils::write_to_log(__FUNCTION__, 'error recive login object while recive response from the db', array('name' => $name,'pass'=>$pass));
				$sd->ass('login_message',' חלה תקלה במערכת אנא נסה שנית או צור קשר עם התמיכה');
				return false;
			}
		}else{
			$sd->ass('login_message','שם המשתמש או הסיסמה אינם נכונים אנא נסה שנית');
			return false;		
		}
	}
	/**
	 * 
	 * פונקציה שיוצרת ורושמת משתנה דינאמי על מנת לבצע
	 * זיהוי משתמש במקרה של משתמש קיים 
	 * ומכניסה את הערך לתוך עוגייה בדפדפן של המשתמש
	 */
	function writeLoggedUser()
	{
		global $conn;
		$logged = $conn->GetOne("select count(*) from login where userid = " . $this->userid);
		if ($logged > 0 ){
			$conn->_query("delete from login where userid= ".$this->userid);
		}
		$rand = md5(uniqid(mt_rand(), true));
		$conn->_execute("insert into login (userid,random,ip,l_date) values ('".$this->userid."','".$rand."','".$_SERVER['REMOTE_ADDR']."',now() * 1);");
		setcookie("user",$this->nickName,time()+60*60*24*3);
		setcookie("token",$rand,time()+60*60*24*3);
	}
	
	/**
	 * 
	 * פונקציה שבודקת משתמשים חוזרים(שיש להם עוגיה שייצרנו)
	 * הפונקציה בודקת אם העוגיה ולידית (הטוקן רשום בדאטה בייס 
	 * ושהכניסה האחרונה לא התבצעה לפני יותר מחודש 
	 * במקרים הנ"ל הפונקציה לדף לוגין עם הודעה מתאימה ובקשה להרשם שנית 
	 */
	public function checkUser()
	{
		//@todo check this again I am disabling this for now 10.2.2012
		return;	
		global $conn;
		if(!empty($_COOKIE['user']) && !empty($_COOKIE['token']))
		{
			$query = "select u.*,l.random from users u inner join login l on u.id = l.userid   where u.nickName = '".$_COOKIE['user']."'and random = '".$_COOKIE['token'] ."' limit 1";
			$res = $conn->Execute($query);
			//krumo ($res->RecordCount( ) > 0);
			if($res->RecordCount() > 0){ 
				 $res->FetchInto($active);
				$this->userid = $active["id"];			
				$num = $conn->GetOne ("select datediff(now() * 1,l_date) as `range` from login where userid=".$this->userid); //> 0 then renew the cookie 
				if($num >= 0 && $num < 30 ){
					$this->name = $active['firstName']." ".$active['lastName'];
					$this->premmisions = $active["premmisions"];
					$this->nickName = $active["nickName"];
					$this->token = $active['random'];
					$this->writeLoggedUser();
				}
			}else{
				$this->checkout();
				Utils::write_to_log(__FUNCTION__, 'error recive login object while recive response from the db', array('user' => $_COOKIE['user'],'token'=>$_COOKIE['token']));
				if ($_SERVER['PHP_SELF'] != SERVER_ROOT.'index.php'){
					header('Location: '.SERVER_ROOT.'index.php?action=redirect');
				}
			}
		}else{
			if ($_SERVER['PHP_SELF'] != SERVER_ROOT.'index.php'){
				header('Location: '.SERVER_ROOT.'index.php?action=redirect');
			}
		}
	}
	function check_user_premmisions($premmisions = 0)
	{
		//@todo check the user auth I am disabling this option for now
		return;	
		if(! ($this->premmisions > $premmisions)){
			header('Location: '. SERVER_ROOT .'index.php?auth=failed');
		}
	}
}

?>