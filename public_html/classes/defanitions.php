<?
/**
 * 
 * ������� ������ ����� ����� ���� ����� �����
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
	 * ����� �� ��� ��� ������ ������
	 * @see public_html/classes/Deployment::Insert()
	 */
	public function Insert()
	{
		extract($_REQUEST);
		$query = "Insert into defanitions(item_id,name) values ($items,'". Utils::UnicodeFix($defanition)  ."')";
		$this->conn->Execute($query);
	}
	
	/**
	 * ����� ��� ���� ������ ������
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
	 * ����� ��� ���� ������ ������
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
	 * ����� ���� ����� ����� ������ ���� ����
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
	 * ����� ������ �� ����� ����� ��� ����� ����
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
	 * �������� ������ ���� �� ���� ��� ��� �� �����
	 * @param string $var �� ������ 
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
	 * ����� �� ��� ���� ����� ����� ����� ��� ����� �� �� ����
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
	 * ������� ������ ���� ������� ���� ���� �'���
	 * ����� ������ ������ ����� ������ ������ ���� �� ����
	 * @param array $result ���� �� ������ ������� ��� ���� ���
	 * @return string ������ ������� ���� ������ ����� �'���
	 */
	public function jsonData($result)
	{
		return "[".substr(Utils::arr2jsonHeb($result),3)."]";
	}
	
	/**
	 * 
	 * �������� ����� ����� �� �� ���� �� ����� 
	 * ������� ���� ������ ���� ���
	 * @param int $item_id ����� �� �� ���� �� ��� �����
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
	 * ������� ������ ������ ������� ����� ������
	 * �� ��� ������ ������ �����
	 * @param $options ���� �� �������� ������ ��� ������ ������ ����
	 * @param $item_smarty_value �� ������ �� ���� ������
	 */
	public function smarty_set_options($options,$item_smarty_value)
	{
		global $smarty;
		$smarty->assign($item_smarty_value,$options);
		
	}
	/**
	 * 
	 * �������� ����� �� ��� ���� �� ������ ����� ������� ������
	 * �� ��� ����� ����� �� ����� ������ �� ����� �� �������
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
	 * ������� ������� �� ����� ���� ����� ������� ������
	 * �� ��� ����� ����� ����� ���� �� �����
	 * @param array $assoc ������ ����� �����
	 * @param int $person_id ���� �� �� ���� �� ����� ������
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