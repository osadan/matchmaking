<?php
 
/**
 * 
 * אובייקט שמטפל באיטרציות של ריבוי מחותנים 
 * @author Ohad Sadan
 *
 */
class RelativesList
	 {
		/**
		 * 
		 * הפונקציה מכניסה \ מעדכנת מערך של ממליצים בטבלה  
		 * @param unknown_type $r
		 */
	 	public function insertList($r)
		{
			$pre = "rel_";
			for ($i = 1,$num = $r["count_rel"];$i<$num;$i++)
			{
				if($r[$pre.'familyName'.$i] != ""){
					$temp = new Relatives($r[$pre."familyName".$i],$r[$pre."type".$i],$r[$pre."flow".$i],$r[$pre."work".$i],$r[$pre."address".$i],$r[$pre."phone".$i],$r[$pre."comment".$i],$r["id"]);
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
		}
	 }
/**
 * 
 * מחלקה לטיפול בממליצים של מועמד
 * @author Ohad Sadan
 *
 */
 class Relatives extends Deployment
	{
		public $familyName,$type,$flow,$work,$address,$phone,$comment,$pid,$count;
		public function __construct($familyName = "",$type= "",$flow= "",$work= "",$address= "",$phone= "",$comments= "",$pid= "")
		{
			parent::__construct();
			$this->familyName = $familyName;
			$this->type = $type;
			$this->flow =$flow;
			$this->work =$work;
			$this->address =$address;
			$this->phone =$phone;
			$this->comments =$comments;
			$this->pid = $pid;
		}
		/**
		 * כתיבה של שורה חדשה בטבלה
		 * @see public_html/classes/Deployment::Insert()
		 */
		public function Insert()
		{
			$query = "Insert Into relatives (pid,flow,familyName,type,address,phone,comments,work) values($this->pid,'$this->flow','$this->familyName','$this->type','$this->address','$this->phone','$this->comments','$this->work')";
			$this->conn->Execute($query);
		}
		/**
		 * עריכת שורה חדשה בטבלה
		 * @see public_html/classes/Deployment::Edit()
		 */
		public function Edit($item)
		{
			$query = "Update relatives set flow = '$this->flow', type='$this->type',familyName='$this->familyName',address='$this->address',phone='$this->phone',comments='$this->comments',work='$this->work',pid='$this->pid' where id=".$item;
			try{
				$this->conn->Execute($query);
		 		if($this->conn->Affected_Rows()> 0){
					return "השינוי בוצע בהצלחה";
				}
			}catch(Exception $e){
					Utils::writelog("UpdateQuery:relatives:".$query);
					Utils::writelog("Exception:".$e->getMessage());
	 				throw "חלה תקלה במערכת נא להתקשר לאחראי";
			}
		}
		public function Delete($item){}
		public function SingleView($item){}
		
		/**
		 * (פונקציה ששולפת את הממליצים של המועמד מתוך הטבלה)
		 * @see public_html/classes/Deployment::plurelView()
		 */
		public function plurelView($item)
		{
			if(is_numeric($item)){
				$query = "select *  from relatives  where pid = ".$item;
				$arr = $this->conn->GetAll($query);
				$i = 0;
				if(count($arr) > 0){
					foreach ($arr as $value)
					{
						
						$this->sd->append('rel',$value);
						$i++;
					}
				}
				while ($i < 3)
				{
					$this->sd->append('rel',array());
					$i++;
				}
				$this->sd->ass('count_rel', $i);
			}
		}
		public function view($item,$message=""){}
		
	}
?>