<?php
 class emptyObject
{

}
/**
 * 
 * פונקציה אבסטרקטית שממנה יורשים כל האובייקטים שמטפלים בגישה לנתונים
 * 
 *
 */
abstract class Deployment
	{
		protected $page,$num,$total,$records,$table,$conn,$sd;
		function __construct()
		{
			$this->conn = Utils::giveMeConnection();
			$this->sd = Utils::giveMeSmarty();
		}
		
		/**
		 * 
		 * פונקציה אבסטרקטית שמשמשת להזנת נתונים חדשים בטבלה
		 */
		abstract public function Insert();
		
		/**
		 * 
		 * פונקציה אבסטרקטית שמשמשת לעריכת נתונים קיימים בטבלה
		 * @param  $item זיהוי חד חד ערכי של שורה
		 */
		abstract public function Edit($item);
		
		/**
		 * 
		 * פונקציה אבסטרקטית שמשמשת למחיקת שורה בטבלה
		 * @param $item זיהויי חד חד ערכי של השורה בטבלה
		 */
		abstract public function Delete($item);
		
		/**
		 * 
		 * פונקציה שמטרתה להציג פרטי בודד מתוך הטבלה לפי זיהויי חד חד ערכי
		 * @param unknown_type $item מפתח הזיהויי החד חד ערכי של השורה בטבלה
		 */
		abstract public function SingleView($item);
		
		/**
		 * 
		 * פונקציה שמשמשת לתצוגה של ערכים מרובים מתוך טבלה
		 * @param unknown_type $item  מפתח זיהוי כלשהו 
		 */
		abstract public function plurelView($item);
		
		/**
		 * 
		 * פונקציה שמשמשת לתצוגה אחרת של הנתונים מטבלה נתונה
		 * @param $item מפתח
		 * @param $message הודעה
		 */
		abstract public function view($item,$message="");
		
		/**
		 * 
		 * פונקצית שרות שבודקת אם קיים ערך חד חד ערכי של מועמד בטבלה נתונה
		 * @param $item מספר הזיהוי החד חד ערכי של מועמד
		 */
		public function checkExist($item)
		{
			$query = "select * from $this->table where id = ".$item ;
			$rs = $this->conn->Execute($query);
			return $rs->numrows() > 0 ;
			
		}
		
		/**
		 * 
		 * פונקצית שרות שבודקת אם קיים ערך חד חד ערכי של מועמד בטבלה נתונה
		 * משמש לבדיקה בטבלאות מקושרות לטבלת פרטים מרכזיים
		 * @param $item מספר הזיהוי החד חד ערכי של מועמד
		 */
		public function checkExistPid($item)
		{
			$query = "select * from $this->table where pid = ".$item ;
			$rs = $this->conn->Execute($query);
			return $rs->numrows() > 0 ;
		}
	
		
	}
?>