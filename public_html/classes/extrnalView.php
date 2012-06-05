<?php
/**
 * 
 * מחלקה שמטרתה לטפל במשתנים שבאים כתוצאה מבחירה
 * בתיבת בחירה מרובה בדף מראה חיצוני
 * 
 *
 */
	class extrnalView extends Deployment
	{
		private $userid;
		private $def;
		function __construct()
		{
			parent::__construct(); 
			$this->def = new Defanitions();
			$this->table = "extrnalview";
		}
		/**
		 * הזנת שורה חדשה לטבלה
		 * @see public_html/classes/Deployment::Insert()
		 */
		public function Insert()
		{
			extract($_REQUEST);
			$query ="insert into Shiduchim.extrnalview 
				(p_id, bird, hat, suit, sideburns, height, fabric, generalLook,outLook,wigg,glasses)
				values
				( $id, '$bird', '$hat', '$suit', '$sideburns', '$height', '$fabric', '$generalLook','$outLook','$wigg','$glasses')";
				
				
			if ($this->conn->_query($query) === false) {
				print 'error inserting: '.$this->conn->ErrorMsg().'<BR>';
			}else{
				$assoc = array ("3" => $bird,"7" => $hat,'4'=>$suit,'6'=>$sideburns,'8'=>$wigg,'9'=>$outLook );
				$this->def->save_defanition_for_query_multy($assoc,$id);
				$this->sd->message("הנתונים הוזנו בהצלחה",false);
			}
		}
		
		/**
		 * עריכת שורה קיימת בטבלה
		 * @see public_html/classes/Deployment::Edit()
		 */
		public function Edit($item)
		{
			extract($_REQUEST);
			$query = "update extrnalview set bird='$bird',hat='$hat',suit='$suit',sideburns=
			'$sideburns',height='$height',fabric='$fabric',generalLook='$generalLook',outLook='$outLook',wigg='$wigg',glasses='$glasses' where p_id = ".$item;
			try{
				$res = $this->conn->Execute($query);
				if($this->conn->Affected_Rows() > 0 ){
					$assoc = array ("3" => $bird,"7" => $hat,'4'=>$suit,'6'=>$sideburns,'8'=>$wigg,'9'=>$outLook );
					$this->def->save_defanition_for_query_multy($assoc,$item);
					$this->sd->message("השינוי בוצע בהצלחה",true);
				}else{
					$this->sd->message("לא בוצעו שינויים",true);
				}
				
				
			}
			catch (Excetpion $e){
				Utils::writelog("UpdateQuery:mainDetails:".$query);
				Utils::writelog("Exception:".$e->getMessage());
				throw "חלה תקלה במערכת נא להתקשר לאחראי";
			}
			
		}
		public function Delete($item)
		{
		
		
		}
		public function SingleView($item)
		{}
		public function plurelView($item)
		{}
		
		/**
		 * יצירת פונקציות צד לקוח אשר 
		 * מאתחלות את תיבות הבחירה בנתונים הנבחרים
		 * כולל הזנת מגדר המועמד בשכבת התצוגה
		 * @see public_html/classes/Deployment::view()
		 */
		public function view($item,$message="")
		{
			if (is_numeric($item)){
				$query = "select * from extrnalview where p_id = ".$item ;
				$rs = $this->conn->Execute($query);
				if($rs->RecordCount() > 0){
					$arr = $rs->FetchRow();
					$this->sd->bind($arr);
					$this->sd->bindSelect(array("bird"=>$arr['bird'],"hat"=>$arr['hat'],"suit"=>$arr["suit"],"sideburns"=>$arr["sideburns"],'wigg'=>$arr['wigg'],'outLook'=>$arr['outLook']));
					$this->sd->bindCheckbox(array("glasses"=>$arr['glasses']));
				}
				$query = "select gender from person where id= ".$item;
				$this->sd->script .="\n setGender(".($this->conn->getOne($query)== 'male' ?'true':'false').");";
				return;
			}else {
				return "";
			}
		}
		
		/**
		 * בדיקה אם קיימת כבר שורה בטבלה
		 * @see public_html/classes/Deployment::checkExist()
		 */
		public function checkExist($item)
		{
			
			$query = "select * from $this->table where p_id = ".$item ;
			$rs = $this->conn->Execute($query);
			return $rs->numrows() > 0 ;
		}
		
	}
?>