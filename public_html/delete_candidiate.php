<?
require_once ('libs/settings.php');
require_once('classes/dbHandler.php');
require_once('classes/Dates.php');
require_once('classes/QueryGenerator.php');
require_once('classes/Meetings.php');
global $conn;
global $smarty;
$sd = Utils::giveMeSmarty();
$dates = new myDates();
$search_terms = new SearchTerms();
$main_details = new MainDetails();
$id = $_REQUEST['id'];
if (is_numeric($id)){
	$main_details->disable_person($id);
	header('Location: '. SERVER_ROOT .'index.php?action=disable_person');
}
