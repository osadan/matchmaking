<?php

/**
 * 
 * אובייקט שמטרתו לבצע איטרציה על ריבוי ערכים 
 * שמתקבלים מבקשה של דפדפן עבור ממליצים של מועמד
 * 
 *
 */
class AdvocatsList
	{
		public function insertList($r)
		{
			$pre = "adv_";
			for($i = 1,$num = $r["count_adv"] + 1;$i<$num;$i++) 
			{
			//echo "i=.".$i.BR;
				if($r[$pre."name".$i] != ""){
					$temp = new Advocats($r[$pre."name".$i],$r[$pre."relate".$i],$r[$pre."phone".$i],$r[$pre."address".$i],$r[$pre."work".$i],$r[$pre."recommand".$i],$r["id"]);
					if($r[$pre."id".$i] == ""){
						$temp->Insert();
					}else{
						$temp->Edit($r[$pre."id".$i]);
					}
				}
				else{
					break;
				}
			}
			return $i;
		}
	}
	/**
	 * 
	 * מחלקה לטיפול בנתונים עבור ממליצים  של מועמד
	 * 
	 *
	 */
	class Advocats extends Deployment
	{
		public $name,$relate,$phone,$address,$work,$recommand,$pid,$count,$comment,$flow;
		function __construct($name="",$relate="",$phone= "",$address= "",$work= "",$recommand= "",$pid= "")
		{
			parent::__construct();
			$this->table = "advocats";
			$this->name = $name;
			$this->relate = $relate;
			$this->phone = $phone;
			$this->address = $address;
			$this->work = $work;
			$this->comment = $comment;
			$this->recommand = $recommand;
			$this->pid = $pid;
			$this->flow = $flow;
		}
		
		/**
		 * הזנת הנתונים לטבלה יצירת שורה חדשה
		 * @see public_html/classes/Deployment::Insert()
		 */
		public function Insert()
		{
			$query = "Insert into advocats(pid,name,relate,phone,address,work,recommand)values($this->pid,'$this->name','$this->relate','$this->phone','$this->address','$this->work','$this->recommand')";
			$this->conn->Execute($query);
		}
		
		/**
		 * עריכת נתונים קיימים בטבלה
		 * @see public_html/classes/Deployment::Edit()
		 */
		 public function Edit($item)
		 {
		 	$query = "Update advocats set name='$this->name',pid='$this->pid',relate='$this->relate',phone='$this->phone',address='$this->address',work='$this->work',recommand='$this->recommand' where id=".$item;
	 		try{
		 		$this->conn->Execute($query);
		 		if($this->conn->Affected_Rows()> 0){
					return "השינוי בוצע בהצלחה";
				}
		 	}catch(Exception $e){
		 		Utils::writelog("UpdateQuery:advocats:".$query);
		 		Utils::writelog("Exception:".$e->getMessage());
		 		throw "חלה תקלה במערכת נא להתקשר לאחראי";
		 	}	
		}
		 public function Delete($item){}
		 public function SingleView($item){}
		 
		 /**
		  * תצוגה מרובה של ערכים מתוך הטבלה
		  * להצגה כטבלה 
		  * הערכים מועברים דרך משתני פרזנטציה
		  * @see public_html/classes/Deployment::plurelView()
		  */
		 public function plurelView($item)
		 {
			if(is_numeric($item)){
			 	$query = "select *  from $this->table  where pid = ".$item;
				$arr = $this->conn->GetAll($query);
				$i = 0;
				if(count($arr) > 0){
					foreach ($arr as $value)
					{
						//print_r($value);
						$this->sd->append('adv',$value);
						$i++;
					}
				}
			 	while ($i < 3)
				{
					$this->sd->append('adv',array());
					$i++;
				}
				$this->sd->ass('count_adv', $i);
			}
		 }
		 public function view($item,$message="")
		 {
		 
		 
		 }
	}
?>