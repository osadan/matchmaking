<?
/**
 * 
 * ������� ������ ���� ������ ���� ����� ������ �� ���� ������� �����
 * ���� ���� ������
 * ������� ����� ���� ����
 *
 */

class Items   extends Deployment
{
	
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * 
	 * ������� ������� ���� ���� ����� ���
	 * @return ���� ������ ���� �����
	 */
	public function Insert()
	{
		extract($_REQUEST);
		$gender = Utils::UnicodeFix($gender);
	//	return $gender;
		if ($gender == 'null') {
			$gender = 'both';
		}
		$query = "Insert into Items (name,var,gender) value ('". Utils::UnicodeFix($item) ."','". Utils::UnicodeFix($var) ."','".$gender."');";
		$this->conn->Execute($query);
		return $this->conn->lastInsID."@@@".$item; 	
	}
	/**
	 * ������ ������ ����� ��� ���� �� ���� ������
	 *
	 */
    public function Edit($item)
	{
		extract ($_REQUEST);
		$query = "";
		$this->conn->Execute($query);
	}
	/**
	 * ������� ������ ����� 
	 * @see public_html/classes/Deployment::Delete()
	 */
	public function Delete($item)
	{
		//@@todo delete also all the defanition related to the item
		$query = "delete from items  where id = ".$item;
		$this->conn->Execute($query);
	}
	/**
	 * ������� ������ ���  ����� �����  �������� ������
	 * 
	 */
	public function SingleView($item)
	{
		$query = "select * from items where id=".$item;
		$arr = $this->conn->GetAll($query);
		$this->sd->bind($arr[0]);
		$this->sd->bindSelect();
		return;
	}
	public function plurelView($item)
	{
		
	}
	public function view($item,$message=""){}
	
	/**
	 * 
	 * * ������� ������� ��� ����� ����� �������� ������
	 */
	public function setSelect()
	{
		global $smarty;
		$query = "select id,name from items;";
		$result = $this->conn->GetAll($query);
		foreach($result as $key =>$value)
		{
			$ids [] = $value["id"];
			$names[] = $value["name"];
		}
		$smarty->assign('items_ids',$ids);
		$smarty->assign('items_names', $names);
		
	}
}
?>