<?php
/**
 * 
 * ������� ������ ���� ���� ������
 * ������ ����� �� ����� ���� ��� ����� ������� ������ ���� ����� ���� �� �����
 * @param $params ������� ������� ���� ������ �������� ����� ������
 * @param $smarty ������� �� ���� ������
 */
function show_candidate_details_short($params,&$smarty)
{
	$candidate = $params['item'];
	$status = '���� ������';
	if (isset($candidate['offers'])){
		$dont_show_link = false;
		foreach ($candidate['offers'] as $offer)
		{
			$statuses []= $offer['status'];
			if (($offer['boy_id'] == $params['person_id']) || ($offer['girl_id'] == $params['person_id'])){
				switch ($offer['status']){
					case 'MazalTov' :
						$status = '���� ����� �� ����� �����';
						break;
					case 'meeting' :
						$status = '������ �� ����� �����';
						break;
					case 'offer' :
						$status = '���� ��� ������ �����';
						break;
					case 'refused' : 
						$status = '������ ��� �� ������ ������';
						break;			
				}
				$dont_show_link = true;
			}
		}
		//ENUM('offer','meeting','refused','MazalTov')
		if (!$dont_show_link){
			$statuses = array_unique($statuses);
			if (in_array('MazalTov',$statuses)){
				$status = '���� �����';
			}else if (in_array('meeting',$statuses)){
				$status = '������';
			}else if (in_array('offer',$statuses)){
				$status = '�����';
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
								<li class='current-status'><span class='label '>����� �����:</span><span class='desc'>{$status}</span></li>";
								if (!$dont_show_link){
									$buf .="<li class='candidate-options'><a href='javascript:void(0)' onclick='save_offer(this,{$candidate['id']},{$params['person_id']},\"{$params['person_gender']}\",\"".SERVER_ROOT."\")'>���� ������</a></li>" ;
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
 * ������� ������ ����� ����� ���� ������� ������� ������
 * ������ ����
 * @param $params ������� ������� ���� ������ �������� ����� ������
 * @param $smarty ������� �� ���� ������
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
			$candidate_status = '�� ���� �����';
		}
	}else if ($type == 'meeting'){
		$candidate_status = $candidate['meeting_number'] > 0 ? "����� ���� ".$candidate['meeting_number'] : '���� ����� 1' ;
	}
	$buf = "<div class='candidate-offer ui-state-default' >
				<div class='candidate-header ui-widget-header ui-corner-all'>
					<span class='ui-icon ui-icon-plusthick'></span>
					<div class='headerText'>
						<div>
							<a class='ui-widget-header candidate-header-name' href='" .SERVER_ROOT. "candidate.php?id={$candidate['id']}' target='_blank'>	{$candidate['firstName']}&nbsp; {$candidate['lastName']}</a>		
						</div>
						<div>
							�����: {$candidate_status}
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
 * ������� ������ ����� �� ����� ������ ����
 * @param $candidate ���� �� ����� �� ������
 * @param $type ��� ������
 * @param $person_id ���� ����� �� �� ���� �� ������ ����� ���� ������ ��"�
 */
function candidate_offers_panel($candidate,$type,$person_id)
{
		$buf = "<div class='candidate-meetings-panel'>
		<div class='meetings-tabs' id='#meetings-tabs' style=''>
			<ul>
				<li><a href='#meetings-tab-{$candidate['id']}-1'><span>���� �����</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-2'><span>����� ����</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-3'><span>��������</span></a></li>
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
 * ������� ������� ����� �� ����� ����� ������ �����
 * @param $candidate ���� �� ������ �� ������
 * @param $type ��� ������
 * @param $person_id ����� �� �� ���� �� ������ ����� ����� ��������
 */
function candidate_meetings_panel($candidate,$type,$person_id)
{
	$buf = "<div class='candidate-meetings-panel'>
		<div class='meetings-tabs' id='#meetings-tabs' style=''>
			<ul>
				<li><a href='#meetings-tab-{$candidate['id']}-1'><span>���� �����</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-2'><span>���� ������</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-3'><span>����� �����</span></a></li>
				<li><a href='#meetings-tab-{$candidate['id']}-4'><span>��������</span></a></li>
				
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
 * ������� ������� ����� �� ����� ����� ������ �����
 * @param $candidate ���� �� ������ �� ������
 * @param $type ��� ������
 * @param $person_id  ����� �� �� ���� �� ������ ����� ����� ��������
 */
function candidate_refused_panel($candidate,$type,$person_id)
{
	
}


/**
 * 
 * ������� ������ ����� �� ����� ������ ������ ���
 * @param array $candidate ���� �� ���� ������
 * @param string $class ����� ���� ����� �����
 */
function show_candidate_details($candidate,$class)
{
	return "<div class='candidate-content {$class}'>
						<div>
							<span class='label'>���</span>:<span class='desc'>" . myDates::deCalcAge($candidate['age']) . "</span>
							<span class='label'>�����</span>:<span class='desc'>".$candidate['accupation']."</span>
						</div>
						<div>
							<span class='label'>���</span>:<span class='desc'>".$candidate['flow']."</span>
							<span class='label'>����</span>:<span class='desc'>".$candidate['origin']."</span>
						</div>
						<div>
							<span class='label'>�����</span>:<span class='desc'>".$candidate['phone']."</span>
							<span class='label'>������</span>:<span class='desc'>".$candidate['cellphone']."</span>
						</div>
						<div>
							<span class='label'>����</span>:<span class='desc'>".$candidate['street']."</span>
							<span class='label'>�����</span>:<span class='desc'>".$candidate['neighborhood']."</span>
							<span class='label'>���</span>:<span class='desc'>".$candidate['city']."</span>
						</div>
						<div>
							<span class='label'>�����</span>:<span class='desc'>".$candidate['comments']."</span>
						</div>
						
					</div>";
}

/**
 * 
 * ������� ������ ��� ����� ���� ������� ������
 * @param array $candidate ����� �� ������
 * @param string the ��� ������
 * @param  ����� �� �� ���� �� ������ ����� ����� ��������
 * @return html string ������ ������ 
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
						<label>��� �����</label>
						<select name='offer_status'>
							<option value='offer' ".($type == 'offer' ? "selected='selected'" : '').">�����</option>
							<option value='meeting' ".($type == 'meeting' ? "selected='selected'" : '').">�������</option>
							<option value='refused' ".($type == 'refused' ? "selected='selected'" : '').">���� �����</option>
							<option value='MazalTov' ".($type == 'MazalTov' ? "selected='selected'" : '').">��� ���</option>
							
						</select>
					</div>
				</div>	
				<div class='formRow'>
					<div class='cell'>
						<label>����� ��</label>
						<select name='boy_offer_status'>
							<option value='0'>--���--</option>
							{$offer_status_options_boy}
						</select>
					</div>
				</div>
				<div class='formRow'>	
					<div class='cell'>	
						<label class='cell'>����� ��</label>
						<select name='girl_offer_status'>	
							<option value='0'>--���--</option>
							{$offer_status_options_girl}
						</select>
					</div>
				</div>
				<div class='clear save-change-space'></div>
				<div class='formRow'>
					<div class='cell'>
						<button role='button' onClick='' >���� �������</button>
					</div>	
				</div>
			</div>
			<div class='tab-region-right'>
				<label>���� �����:</label>
				<textarea rows='10' cols='53' name='offer_remarks'>
				</textarea>
			</div>
		</form>	
	";
	return $buf;
}	

/**
 * 
 * ������� ������ ��� ���� ����� �� �������
 * @param array $meetings ���� ������ ������ ���� �� �������
 * @param int $offer_id ���� �����
 */
function show_candidate_meetings($meetings,$offer_id)
{
	$output .= "<div>
		<a class='add-new-meeting' href='javascript:void(0)'>
			<span class='ui-icon ui-icon-plusthick'></span><span class='add-new-meeting-text'>���� �����</span></a>
			
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
 * ���� ����� ����� ����
 * @param $offer_id ���� �����
 */
function new_meeting_form($offer_id)
{ 
	$mydates = Utils::giveMeMyDates();
	$buf = "<form  name='meeting_form' id='meeting_form-$offer_id'>
				<input type='hidden' id='offer_id' name='offer_id' value='{$offer_id}'/> 
				<div class='formRow'>
					<div class='cell'>
						<label>����� ������</label>
						<input type='text' name='meeting_place' >
					</div>
					<div class='cell'>
					";
						$buf .= myDates::hebraw_date_select_control($mydates->current_jewish_year,1,1);
			$buf.="</div>
					<div class='cell'>".
						Utils::generate_select_box( myDates::time(), 'meeting-time', '���','time', $id,'20:00')
					."</div>
				</div>
				<div class='formRow'>
					<div class='cell'>
						<label>�����</label>
						<textarea name='remarks' rows='3' cols='60'></textarea>
					</div>
				</div>
				<div class='formRow'>
					<div class='cell'>
						<button role='button' onclick='return save_meeting({$offer_id});'><span>����</span></button>
					</div>
				</div>
			</form>";
	return $buf;
}

/**
 * 
 * ������� ������ ���� ���� ����� �� �� �������
 * @param $meetings ���� �� �� �������
 */
function generate_meetings_table($meetings)
{
	$count = '1';
	$output = "<table class='tbl-meetings-table'>
					<tr class='header-row'><th>�����</th><th>���</th><th>����</th><th>�����</th><th>������</th></tr>";
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
											<button role='button' class='edit-meeting ' onclick='edit_meeting({$json},$json_fix);return false;'>���� �����</button>
											<button role='button' class='remove-meeting' onclick='remove_meeting({$value['m_id']});return false;'>���</button>
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
							��
						<a href='{SERVER_ROOT}candidate.php?id={$value['girl_id']}&type=show_offers'> 
							{$value['girl']}</a>({$value['status_girl']})	
					</li>";
	}
	return $output.'</ul>';
}