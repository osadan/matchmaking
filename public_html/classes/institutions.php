<?php
/**
 * 
 * מחלקה שמטפלת באיטרציות של מוסדות לימודיים
 * 
 *
 */
class InstitutionsList
	{
		public function insertList($r)
		{
			//echo "in func" ;
			$pre = "inst_";
			//echo  $r["count_inst"];
			for ($i = 1 ,$num = $r["count_inst"] + 1; $i < $num ;$i++)
			{
				//echo $r[$pre."_from".$i];
				if ($r["inst_name".$i] != ""){
					$temp = new Institutions($r[$pre."from".$i],$r[$pre."to".$i],$r[$pre."name".$i],$r[$pre."comment".$i],$r["id"]);
					if($r[$pre."id".$i] == ""){
					$temp->Insert();
					}else{
						$temp->Edit($r[$pre."id".$i]);
					}
				}else{
					break;
				}
			}
			return $i;
		}	
	}
	/**
	 * 
	 * 
	 * מחלקה שמטפלת בהזנת נתונים של מוסדות לימודיים
	 *
	 */
	 class Institutions extends Deployment
	{
		public $from,$to,$id,$pid,$comment,$name,$count;
		function __construct($from="",$to="",$name="",$comment="",$pid="")
		{
			parent::__construct(); 
			$this->table = "institutions";
			$this->prefix = "inst";
			$this->from = $from;
			$this->to = $to;
			$this->name = $name;
			$this->comment = $comment;
			$this->pid = $pid;
		}
		/**
		 * הכנסת נתונים לתוך הטבלה
		 * @see public_html/classes/Deployment::Insert()
		 */
		public function Insert()
		{
			$query = "insert into institutions (pid,name,y_from,y_to,comment) values($this->pid,'$this->name','$this->from','$this->to','$this->comment');";
			$this->conn->Execute($query);
		}
		/**
		 * עריכת נתונים בטבלה
		 * @see public_html/classes/Deployment::Edit()
		 */
		 public function Edit($item)
		 {
			$query = "update institutions set pid = $this->pid,name= '$this->name',y_from = '$this->from',y_to = '$this->to',comment = '$this->comment' where id=".$item;
			try{	
				$this->conn->Execute($query);
		 		if($this->conn->Affected_Rows()> 0){
					return "השינוי בוצע בהצלחה";
				}
			}catch(Exception $e){
	 			Utils::writelog("UpdateQuery:institutions:".$query);
				Utils::writelog("Exception:".$e->getMessage());
				throw "חלה תקלה במערכת נא להתקשר לאחראי";
	 		}	
		 }
		 public function Delete($item){}
		 public function SingleView($item){}
		 /**
		  * תצוגת נתונים בתצורה טבלאית
		  * ע"י הזנת הנתונים למשתני תצוגה
		  * @see public_html/classes/Deployment::plurelView()
		  */
		 public function plurelView($item)
		 {
			if (is_numeric($item)){
			 	$query = "select *,y_from as `from`,y_to as `to`  from institutions where pid = ".$item;
				$arr = $this->conn->GetAll($query);
				$i = 0;
				if(count($arr) > 0){
					foreach ($arr as $value)
					{
						$this->sd->append('inst',$value);
						$i++;
					}
				}
			 //inset empty values 
				 while ($i < 3)
				{
					$this->sd->append('inst',array());
					$i++;
				}
				$this->sd->ass('count_inst', $i);
			 }
		 }
		 public function view($item,$message="")
	 	{}
	 	/**
	 	 * 
	 	 * פונקציה שמחזירה מערך של כל המוסדות הלימודיים 
	 	 * הפונקציה תחזיר רק ערכים יחידים
	 	 */
	 	public function get_all_institutions()
	 	{
	 		$query = "select name from institutions";
	 		$result = $this->conn->GetAll($query);
			$names = array ();
	 		foreach($result as $value){
				$names[] = $value['name'];
			}
			return array_unique($names);	
	 	}
	 	
	 }
?>