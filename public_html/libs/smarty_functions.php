<?php
/**
 * 
 * פונקציה שנקראת מתוך שכבת התצוגה
 * מחזירה תצוגה של מועמד בודד בדף בחירת מועמדים להצעות בתוך כרטיס אישי של מועמד
 * @param $params פרמטרים שמוזנים בתוך הקריאה לפונקציה בשכבת התצוגה
 * @param $smarty אובייקט של שכבת התצוגה
 */
function show_candidate_details_short($params,&$smarty)
{
	$candidate = $params['item'];
	$status = 'פנוי להצעות';
	if (isset($candidate['offers'])){
		$dont_show_link = false;
		foreach ($candidate['offers'] as $offer)
		{
			$statuses []= $offer['status'];
			if (($offer['boy_id'] == $params['person_id']) || ($offer['girl_id'] == $params['person_id'])){
				switch ($offer['status']){
					case 'MazalTov' :
						$status = 'נסגר שידוך עם מועמד נוכחי';
						break;
					case 'meeting' :
						$status = 'בפגישה עם מועמד נוכחי';
						break;
					case 'offer' :
						$status = 'הוצע כבר למועמד נוכחי';
						break;
					case 'refused' : 
						$status = 'נסתיים קשר עם המועמד הנוכחי';
						break;			
				}
				$dont_show_link = true;
			}
		}
		//ENUM('offer','meeting','refused','MazalTov')
		if (!$dont_show_link){
			$statuses = array_unique($statuses);
			if (in_array('MazalTov',$statuses)){
				$status = 'נסגר שידוך';
			}else if (in_array('meeting',$statuses)){
				$status = 'בפגישה';
			}else if (in_array('offer',$statuses)){
				$status = 'בהצעה';
			}
		}
	}
	$buf = "<li class='ui-state-default'>
				<div class='candidate'>
					<div class='candidate-header ui-widget-header ui-corner-all'>
						<span class='ui-icon ui-icon-plusthick' style='float: left;'></span>
						<div class='headerText'>
						<div><a class='ui-widget-header candidate-header-name' href='" .SERVER_ROOT. "candidate.php?id={$candidate['id']}' target='_blank'>" . $candidate['firstName'] ." " . $candidate['lastName'] . "</a></div>
						<div>
							<ul class='candidate-list-status'>
								<li class='current-status'><span class='label '>סטטוס נוכחי:</span><span class='desc'>{$status}</span></li>";
								if (!$dont_show_link){
									$buf .="<li class='candidate-options'><a href='javascript:void(0)' onclick='save_offer(this,{$candidate['id']},{$params['person_id']},\"{$params['person_gender']}\",\"".SERVER_ROOT."\")'>הוסף להצעות</a></li>" ;
								}
							$buf.="</ul>
						</div>
						</div>
					</div>".
				 show_candidate_details($candidate,'candidate-search')		
			."</li>";
	return $buf;
}

/**
 * 
 * פונקציה שמציגה כרטיס מועמד עבור מועמדים שרשומים כהצעות
 * למועמד נתון
 * @param $params פרמטרים שמוזנים בתוך הקריאה לפונקציה בשכבת התצוגה
 * @param $smarty אובייקט של שכבת התצוגה
 */
function show_canidate_expended ($params,&$smarty)
{
	extract($params);
	$defanitions = new Defanitions();
	if ($type == 'offers'){
		$candidate_status = $candidate['gender'] == 'male' ? $candidate['status_boy'] : $candidate['status_girl'];
		if ($candidate_status > 0){
			$candidate_status_result = $defanitions->view($candidate_status);
			$candidate_status = $candidate_status_result[0]['name'];
		}else{
			$candidate_status = 'לא נבחר סטטוס';
		}
	}else if ($type == 'meeting'){
		$candidate_status = $candidate['meeting_number'] > 0 ? "פגישה מספר ".$candidate['meeting_number'] : 'לפני פגישה 1' ;
	}
	$buf = "<div class='candidate-offer ui-state-default' >
				<div class='candidate-header ui-widget-header ui-corner-all'>
					<span class='ui-icon ui-icon-plusthick'></span>
					<div class='headerText'>
						<div>
							<a class='ui-widget-header candidate-header-name' href='" .SERVER_ROOT. "candidate.php?id={$candidate['id']}' target='_blank'>	{$candidate['firstName']}&nbsp; {$candidate['lastName']}</a>		
						</div>
						<div>
							סטטוס: {$candidate_status}
						</div>
					</div>
				</div>";
				switch($type){			
					case 'offers':
						$buf .= candidate_offers_panel($candidate,'offers',$person_id);
					break;
					case 'meeting':
						$buf .= candidate_meetings_panel($candidate,'meeting',$person_id);
					break;	
					case 'refused':
						$buf .= candidate_refused_panel($candidate,'refused',$person_id);	
				}
			$buf."</div>";
	return $buf;
}

/**
 * 
 * פונקציה שמציגה כרטיס של מועמד בסטטוס הצעה
 * @param $candidate מערך של נתוני על המועמד
 * @param $type סוג הסטטוס
 * @param $person_id מספר זיהוי חד חד ערכי של המועמד עבורו נבחר המועמד הנ"ל
 */
function candidate_offers_panel($candidate,$type,$person_id)
{
		$buf = "<div class='candidate-meetings-panel'>
		<div class='meetings-tabs' id='#meetings-tabs' style=''>
			<ul>
				<li><a href='#meetings-tab-{$candidate['id']}-1'><span>פרטי מועמד</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-2'><span>סטטוס הצעה</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-3'><span>היסטוריה</span></a></li>
			</ul>
			<div id='meetings-tab-{$candidate['id']}-1'>
			". show_candidate_details($candidate,'candidate-handler') ."
			</div>
			<div id='meetings-tab-{$candidate['id']}-2'>
			". show_candidate_operation($candidate,$type,$person_id)."	
			</div>
			<div id='meetings-tab-{$candidate['id']}-3' class='offer-log'>
				<div class='offer-log-inner ui-widget-content'>{$candidate['log']}</div>
			</div>
		</div>
		
	</div>";
	return $buf;
}

/**
 * 
 * פונקציה שמחזירה כרטיס של מועמד שנמצא בסטטוס פגישה
 * @param $candidate מערך עם נתונים על המועמד
 * @param $type סוג הסטטוס
 * @param $person_id זיהוי חד חד ערכי של המועמד עבורו נבחרו המועמדים
 */
function candidate_meetings_panel($candidate,$type,$person_id)
{
	$buf = "<div class='candidate-meetings-panel'>
		<div class='meetings-tabs' id='#meetings-tabs' style=''>
			<ul>
				<li><a href='#meetings-tab-{$candidate['id']}-1'><span>פרטי מועמד</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-2'><span>פרטי פגישות</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-3'><span>סטטוס פגישה</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-4'><span>היסטוריה</span></a></li>
				
			</ul>
			<div id='meetings-tab-{$candidate['id']}-1'>
			". show_candidate_details($candidate,'candidate-handler') ."
			</div>
			<div id='meetings-tab-{$candidate['id']}-2'>
			". show_candidate_meetings($candidate['meetings'],$candidate['o_id']) ."	
			</div>
			<div id='meetings-tab-{$candidate['id']}-3'>
			". show_candidate_operation($candidate,$type,$person_id)."	
			</div>
			<div id='meetings-tab-{$candidate['id']}-4' class='offer-log'>
				<div class='offer-log-inner ui-widget-content'>{$candidate['log']}</div>
			</div>
		</div>
		
	</div>";
	return $buf;
}

/**
 * 
 * פונקציה שמחזירה כרטיס של מועמד שנמצא בסטטוס דחייה
 * @param $candidate מערך עם נתונים על המועמד
 * @param $type סוג הסטטוס
 * @param $person_id  זיהוי חד חד ערכי של המועמד עבורו נבחרו המועמדים
 */
function candidate_refused_panel($candidate,$type,$person_id)
{
	
}


/**
 * 
 * פונקציה שמציגה פרטים של מועמד בכרטיס התצוגה שלו
 * @param array $candidate מערך עם פרטי המועמד
 * @param string $class מחלקה עבור נתוני תצוגה
 */
function show_candidate_details($candidate,$class)
{
	return "<div class='candidate-content {$class}'>
						<div>
							<span class='label'>גיל</span>:<span class='desc'>" . myDates::deCalcAge($candidate['age']) . "</span>
							<span class='label'>עיסוק</span>:<span class='desc'>".$candidate['accupation']."</span>
						</div>
						<div>
							<span class='label'>זרם</span>:<span class='desc'>".$candidate['flow']."</span>
							<span class='label'>מוצא</span>:<span class='desc'>".$candidate['origin']."</span>
						</div>
						<div>
							<span class='label'>טלפון</span>:<span class='desc'>".$candidate['phone']."</span>
							<span class='label'>פלאפון</span>:<span class='desc'>".$candidate['cellphone']."</span>
						</div>
						<div>
							<span class='label'>רחוב</span>:<span class='desc'>".$candidate['street']."</span>
							<span class='label'>שכונה</span>:<span class='desc'>".$candidate['neighborhood']."</span>
							<span class='label'>עיר</span>:<span class='desc'>".$candidate['city']."</span>
						</div>
						<div>
							<span class='label'>הערות</span>:<span class='desc'>".$candidate['comments']."</span>
						</div>
						
					</div>";
}

/**
 * 
 * פונקציה שיוצרת טאב שמראה פרטי התקדמות בשידוך
 * @param array $candidate פרטים של המועמד
 * @param string the סוג הסטטוס
 * @param  זיהוי חד חד ערכי של המועמד עבורו נבחרו המועמדים
 * @return html string מחרוזת לתצוגה 
 */
function show_candidate_operation($candidate,$type,$person_id)
{
	//('offer','meeting','refused','MazalTov')
	$meetings = new Meetings();
	$offer_status_options_boy = $meetings->set_offer_status_combo($candidate['status_boy'],$type);
	$offer_status_options_girl = $meetings->set_offer_status_combo($candidate['status_girl'],$type);
	//krumo($offer_status)
	$buf = "
		<form class='tab' action='".SERVER_ROOT."candidate.php?id={$person_id}' method='post'>
		<input type='hidden'  name='offer_candidate_id' value='{$candidate['id']}' />
		<input type='hidden' name='type' value='$type' />
		<input type='hidden' name='offer_id' value='{$candidate['o_id']}' />
			<div class='tab-region-right'>
				<div class='formRow'>
					<div class='cell'>
						<label>מצב ההצעה</label>
						<select name='offer_status'>
							<option value='offer' ".($type == 'offer' ? "selected='selected'" : '').">בהצעה</option>
							<option value='meeting' ".($type == 'meeting' ? "selected='selected'" : '').">בפגישות</option>
							<option value='refused' ".($type == 'refused' ? "selected='selected'" : '').">הצעה נדחתה</option>
							<option value='MazalTov' ".($type == 'MazalTov' ? "selected='selected'" : '').">מזל טוב</option>
							
						</select>
					</div>
				</div>	
				<div class='formRow'>
					<div class='cell'>
						<label>סטטוס בן</label>
						<select name='boy_offer_status'>
							<option value='0'>--בחר--</option>
							{$offer_status_options_boy}
						</select>
					</div>
				</div>
				<div class='formRow'>	
					<div class='cell'>	
						<label class='cell'>סטטוס בת</label>
						<select name='girl_offer_status'>	
							<option value='0'>--בחר--</option>
							{$offer_status_options_girl}
						</select>
					</div>
				</div>
				<div class='clear save-change-space'></div>
				<div class='formRow'>
					<div class='cell'>
						<button role='button' onClick='' >שמור שינויים</button>
					</div>	
				</div>
			</div>
			<div class='tab-region-right'>
				<label>הוסף הערות:</label>
				<textarea rows='10' cols='53' name='offer_remarks'>
				</textarea>
			</div>
		</form>	
	";
	return $buf;
}	

/**
 * 
 * פונקציה שמציגה טאב עבור תצוגה של הפגישות
 * @param array $meetings מערך שמחזיק נתונים עבור כל הפגישות
 * @param int $offer_id מספר ההצעה
 */
function show_candidate_meetings($meetings,$offer_id)
{
	$output .= "<div>
		<a class='add-new-meeting' href='javascript:void(0)'>
			<span class='ui-icon ui-icon-plusthick'></span><span class='add-new-meeting-text'>הוסף פגישה</span></a>
			
	</div><div class='add-new-meeting-form'>";
		$output .= new_meeting_form($offer_id);
	$output .= "</div>
				<div class='meetings-table'>";
					$output .= generate_meetings_table($meetings);
				$output.="</div>";
	return $output;
}

/**
 * 
 * טופס להזנת פגישה חדשה
 * @param $offer_id מספר ההצעה
 */
function new_meeting_form($offer_id)
{ 
	$mydates = Utils::giveMeMyDates();
	$buf = "<form  name='meeting_form' id='meeting_form-$offer_id'>
				<input type='hidden' id='offer_id' name='offer_id' value='{$offer_id}'/> 
				<div class='formRow'>
					<div class='cell'>
						<label>מיקום הפגישה</label>
						<input type='text' name='meeting_place' >
					</div>
					<div class='cell'>
					";
						$buf .= myDates::hebraw_date_select_control($mydates->current_jewish_year,1,1);
			$buf.="</div>
					<div class='cell'>".
						Utils::generate_select_box( myDates::time(), 'meeting-time', 'שעה','time', $id,'20:00')
					."</div>
				</div>
				<div class='formRow'>
					<div class='cell'>
						<label>הערות</label>
						<textarea name='remarks' rows='3' cols='60'></textarea>
					</div>
				</div>
				<div class='formRow'>
					<div class='cell'>
						<button role='button' onclick='return save_meeting({$offer_id});'><span>שמור</span></button>
					</div>
				</div>
			</form>";
	return $buf;
}

/**
 * 
 * פונקציה שיוצרת טבלה עבור תצוגה של כל הפגישות
 * @param $meetings מערך של כל הפגישות
 */
function generate_meetings_table($meetings)
{
	$count = '1';
	$output = "<table class='tbl-meetings-table'>
					<tr class='header-row'><th>תאריך</th><th>שעה</th><th>מקום</th><th>הערות</th><th>פעולות</th></tr>";
					foreach($meetings as  $value)
					{
						$date = myDates::unserialize_date_time_field($value['meeting_date']);
						$value['meeting_date'] = unserialize($value['meeting_date']) ;
						$json_fix  = "{\"meeting_place\" : \"{$value['meeting_place']}\" ,\"remarks\" : \"{$value['remarks']}\"}";
						$json = json_encode($value);
						$output .= "<tr class='meeting-row' id='meeting-row{$value['m_id']}'>
										<td class='tbl-meeting-date'>{$date['date_string']}</td>
										<td class='tbl-meeting-time'>{$date['time_string']}</td>
										<td class='tbl-meeting-place'>{$value['meeting_place']}</td>
										<td class='tbl-meeting-remarks'>{$value['remarks']}</td>
										<td class='tbl-meeting-actions'>
											<button role='button' class='edit-meeting ' onclick='edit_meeting({$json},$json_fix);return false;'>ערוך פגישה</button>
											<button role='button' class='remove-meeting' onclick='remove_meeting({$value['m_id']});return false;'>הסר</button>
										</td>
									</tr>";
						$count++;
					}
				$output.="</table>";
	return $output;					
}
function get_all_institutions_list($params,&$smarty)
{
	$institutions = new Institutions();
	$arr = $institutions->get_all_institutions();
	$output_list ="";
	
	$output = 'var institutions_list = [';
	if (is_array($arr) && count($arr) > 0 ){	
		foreach ($arr as $value){
			$output_list []= "'".htmlspecialchars($value,ENT_QUOTES)."'";
		} 
		$output_list = implode(',',$output_list);
	}
	$output.=$output_list. '];';
	return $output;
}
/**
 * 
 */
function homepage_view_last_meeting($params,&$smarty)
{	
	$data = $params['data'];
	$output = "<ul>";
	foreach($data as $value)
	{
		$output .= "<li class='meeting-list-item'><a href='".SERVER_ROOT."candidate.php?id={$value['boy_id']}&type=show_offers'> 
							{$value['boy']}</a>({$value['status_boy']})
							עם
						<a href='{SERVER_ROOT}candidate.php?id={$value['girl_id']}&type=show_offers'> 
							{$value['girl']}</a>({$value['status_girl']})	
					</li>";
	}
	return $output.'</ul>';
}