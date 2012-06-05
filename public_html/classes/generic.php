<?php
 class emptyObject
{

}
/**
 * 
 * ������� ��������� ����� ������ �� ���������� ������� ����� �������
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
		 * ������� ��������� ������ ����� ������ ����� �����
		 */
		abstract public function Insert();
		
		/**
		 * 
		 * ������� ��������� ������ ������ ������ ������ �����
		 * @param  $item ����� �� �� ���� �� ����
		 */
		abstract public function Edit($item);
		
		/**
		 * 
		 * ������� ��������� ������ ������ ���� �����
		 * @param $item ������ �� �� ���� �� ����� �����
		 */
		abstract public function Delete($item);
		
		/**
		 * 
		 * ������� ������ ����� ���� ���� ���� ����� ��� ������ �� �� ����
		 * @param unknown_type $item ���� ������� ��� �� ���� �� ����� �����
		 */
		abstract public function SingleView($item);
		
		/**
		 * 
		 * ������� ������ ������ �� ����� ������ ���� ����
		 * @param unknown_type $item  ���� ����� ����� 
		 */
		abstract public function plurelView($item);
		
		/**
		 * 
		 * ������� ������ ������ ���� �� ������� ����� �����
		 * @param $item ����
		 * @param $message �����
		 */
		abstract public function view($item,$message="");
		
		/**
		 * 
		 * ������� ���� ������ �� ���� ��� �� �� ���� �� ����� ����� �����
		 * @param $item ���� ������ ��� �� ���� �� �����
		 */
		public function checkExist($item)
		{
			$query = "select * from $this->table where id = ".$item ;
			$rs = $this->conn->Execute($query);
			return $rs->numrows() > 0 ;
			
		}
		
		/**
		 * 
		 * ������� ���� ������ �� ���� ��� �� �� ���� �� ����� ����� �����
		 * ���� ������ ������� ������� ����� ����� �������
		 * @param $item ���� ������ ��� �� ���� �� �����
		 */
		public function checkExistPid($item)
		{
			$query = "select * from $this->table where pid = ".$item ;
			$rs = $this->conn->Execute($query);
			return $rs->numrows() > 0 ;
		}
	
		
	}
?>