<?~
require_once ('libs/settings.php');
require_once('./classes/Meetings.php');
$conn = Utils::giveMeConnection();				
$items = new Items();
$defanitions  = new Defanitions();

switch($_REQUEST['give_me']){
	case 'nick_compare':
	//	echo "good";
		echo nick_compare($conn,iconv("UTF-8","Windows-1255",$_REQUEST['nickName']));
	break;
	case 'newItem':
		echo $items->Insert();
	break;
	case 'newDefanition':
		$defanitions->Insert();
	case "deleteDefanition":
		if($defanitions->Delete($_REQUEST["id"])){
			echo "good";
		}else{
			echo "bad";
		}
	case "updateDefanition":
			echo $defanitions->Edit("");
	break;
	case "DefanitionList":
		$item_id = iconv("UTF-8","Windows-1255",$_REQUEST['id']);
		if ( is_numeric($item_id)){
			header("Content-Type: text/html; charset=Windows-1255");
			echo $defanitions->jsonData($defanitions->plurelView($item_id));
		}else{
			echo "";
		}	
	break;
	case 'new_offer':
		$mettings = new meetings();
		$result = $mettings->add_new_offer($_REQUEST['boy_id'], $_REQUEST['girl_id']);
		header("Content-Type: application/json; charset=Windows-1255");
		echo json_encode($result);
	break;
	case 'new_meeting' :
			$mettings = new meetings();
			//$data = Utils::iconv_post();
			$result = $mettings->save_new_meeting();
			header("Content-Type: application/json; charset=Windows-1255");
			echo json_encode(array('result' => $result));
			
		break;
	case 'remove_meeting':
			$meeting = new meetings();
			$result = $meeting->remove_meeting($_REQUEST['m_id']);
			header("Content-Type: application/json; charset=Windows-1255");
			echo json_encode(array('result' => $result));
		break;	
}
function nick_compare($conn,$nick)
{
	$query = "select count(*) from users where nickName =  \"$nick\"";
	///Utils::writelog($query);
	return  $conn->GetOne($query);//." ".$query;
}
function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'utf-8');
	
  }
?>