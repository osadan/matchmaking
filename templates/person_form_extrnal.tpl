
	<form name="look" id="look" method="post" action="candidate.php">
			<input type="hidden" value="Look" name="type" id="type2" />
			<input type="hidden" value="{$main_id}" name="id" id="id2"/>
			<input type="hidden" value="{$act2}" name="act" id="act2"/>
			<h3>����</h3>
			<div class="formRow">
				<div class="cell male">
					<label for="bird">:���</label>
					<select name="bird" id="bird">
						<option value=""></option>
						{html_options options=$birds selected=$bird_id}
					</select>
				</div>
				<div class="cell male">
					<label for="hat">:����</label>
					<select name="hat" id="hat">
						<option value=""></option>	
						{html_options options=$hats selected=$hat_id}	
				</select>
				</div>
				<div class="cell male">
					<label for="suit">:�����</label>
					<select name="suit" id="suit">
						<option value=""></option>	
						{html_options options=$suits selected=$suit_id}	
					</select>
				</div>
				<div class="cell male">
					<label for="sideburns">:����</label>
					<select name="sideburns" id="sideburns">
						<option value=""></option>
						{html_options options=$sideburns selected=$sideburns_id}	
					</select>
				</div>
				<div class="cell female">
					<label for="wigg ">: ����� ���</label>
					<select name="wigg" id="wigg">
						<option value=""></option>
						{html_options options=$wiggs selected=$wigg_id}	
					</select>
				</div>
				<div class="cell">
					<label for="outLook">:�����</label>
					<select name="outLook" id="outLook">
						<option value=""></option>
						{html_options options=$outLooks selected=$outLook_id}
					</select>
				</div>
					<div class="formRow">
				<div class="cell">
					<label class="date">: �������</label>
					<input type="checkbox" role="button" id="glasses" name="glasses" value="1" {$glasses} style="margin:4px 4px 0px 0px;" />
				</div>
			</div>
			</div>
			<h3>���� ���</h3>
			<div class="formRow">
				<div class="cell">
					<label for="height">:����</label>
					<input type="text" id="height" name="height" value="{$height}"/>
				</div>
				<div class="cell">
					<label for="fabric">:���� ���</label>
					<input type="text" id="fabric" name="fabric" value="{$fabric}"/>
				</div>
			</div>
		
		<div class="formRow">			
			<div class="cell">
					<label for="generalLook">:���� ����</label>
					<textarea id="generalLook" name="generalLook"  style="width:336px;height:50px;">{$generalLook}</textarea>
			</div>
		</div>
		<div class="buttons">
		<button role="button" onClick="submit_form('look','exit');"><span>���� ���</span></button>
		<button role="button" onClick="submit_form('look','next');"><span>���� �����</span></button>
		
	</div>
		</form>		