<?
require_once('tsedekInit.php');
//require_once('')
$key  ="s0gt1nj3ct";
$sd = new smartyDisplay();

if($_GET['mod']=='test'){
	$a = new auth2();
	$a->approve();
}
if($_GET['mod']=='auth'){
	$a = new auth2();
	$a->display();
}

class auth2
{
	var $auth;
	
	function approve()
	{
		global $key,$smarty;
		$db = new ddb();
		$str = $_POST['pass'];
		$user = $_POST['text'];
		$pass = sha1($key.$str);
		//$pass=$str;
		$user = mysql_escape_string($user);
		$query = "select * from user where username='$user' AND pass = '$pass'";
		//echo $query;
		$db->safeQuery($query);
		//echo $query;
		//echo $db->affected() > 0;
		if($db->affected() > 0){
			session_start();
	 		//print_r($_SESSION); 
			header("Cache-control: private");
	 		 $_SESSION["access"] = "granted";
			 if($_SESSION['page']){
			 	$redirect = $_SESSION['page'];
			 	 header("Location: $redirect");
			}else{
			 	$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'gallery.php?mod=view';
				header("Location: http://$host$uri/$extra"); 
			 }
	 	}
		else{
			$smarty->assign('name',$_POST['text']);
			$smarty->assign('err','Wrong name or password <br /> try again');
			$this->display();
		}
	}
	function display()
	{
		global $sd;
		$sd->displayForm('auth.tpl');
	
	}
	function checkAuth()
	{
		session_start();
		
		header("Cache-control: private");
		//print_r($_SESSION);
		if ($_SESSION["access"] == "granted"){
		//	echo 'yesy';
			//print_r($_SESSION);
			return true;
			
		}
		else{
			//echo 'noo';
			//print_r($_SESSION);
			return false;
		}	
	}
	
}
?>