<?
class Users   extends Deployment
{
	
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * (פונקציה שמכניסה משתמש חדש לדאטה בייס)
	 * @see public_html/classes/Deployment::Insert()
	 */
	public function Insert()
	{
		extract($_REQUEST);
		$query = "Insert into users (firstName,lastName,nickName,address,phone,cellphone,email,comments,password,premmisions,updateDate,insertDate) values ('$firstName','$lastName','$nickName','$address','$phone','$cellphone','$email','$comments','".md5($password)."','$premmisions',now(),now())";
		$this->conn->Execute($query);
			
	}
	/**
	 * (פונקציה שעורכת משתמש קיים בדאטה בייס)
	 * @see public_html/classes/Deployment::Edit()
	 */
    public function Edit($item)
	{
		extract ($_REQUEST);
		$query = "Update users set firstName = '$firstName' , lastName = '$lastName' , nickName='$nickName',address = '$address' , phone = '$phone' , cellphone = '$cellphone' , email = '$email' , comments = '$comments' , premmisions = '$premmisions' , updateDate = now() where id = $user_id;";
		$this->conn->Execute($query);
	}
	/**
	 * (פונקציה שמוחקת משתמש מהדאטה בייס)
	 * @see public_html/classes/Deployment::Delete()
	 */
	public function Delete($item)
	{
		$query = "delete from users where id = ".$item;
		$this->conn->Execute($query);
	}
	/**
	 * (פונקציה שמציגה נתונים על משתמש יחיד )
	 * @see public_html/classes/Deployment::SingleView()
	 */
	public function SingleView($item)
	{
		$query = "select * from users where id=".$item;
		$arr = $this->conn->GetAll($query);
		$this->sd->bind($arr[0]);
		$this->sd->bindSelect(array("premmisions"=>$arr[0]['premmisions']));
		return;//$this->sd->script;
	}
	public function plurelView($item)
	{
		
	}
	public function view($item,$message=""){}
	
	
		
}
?>