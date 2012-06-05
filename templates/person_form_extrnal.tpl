
	<form name="look" id="look" method="post" action="candidate.php">
			<input type="hidden" value="Look" name="type" id="type2" />
			<input type="hidden" value="{$main_id}" name="id" id="id2"/>
			<input type="hidden" value="{$act2}" name="act" id="act2"/>
			<h3>לבוש</h3>
			<div class="formRow">
				<div class="cell male">
					<label for="bird">:זקן</label>
					<select name="bird" id="bird">
						<option value=""></option>
						{html_options options=$birds selected=$bird_id}
					</select>
				</div>
				<div class="cell male">
					<label for="hat">:כובע</label>
					<select name="hat" id="hat">
						<option value=""></option>	
						{html_options options=$hats selected=$hat_id}	
				</select>
				</div>
				<div class="cell male">
					<label for="suit">:חליפה</label>
					<select name="suit" id="suit">
						<option value=""></option>	
						{html_options options=$suits selected=$suit_id}	
					</select>
				</div>
				<div class="cell male">
					<label for="sideburns">:פאות</label>
					<select name="sideburns" id="sideburns">
						<option value=""></option>
						{html_options options=$sideburns selected=$sideburns_id}	
					</select>
				</div>
				<div class="cell female">
					<label for="wigg ">: כיסוי ראש</label>
					<select name="wigg" id="wigg">
						<option value=""></option>
						{html_options options=$wiggs selected=$wigg_id}	
					</select>
				</div>
				<div class="cell">
					<label for="outLook">:הופעה</label>
					<select name="outLook" id="outLook">
						<option value=""></option>
						{html_options options=$outLooks selected=$outLook_id}
					</select>
				</div>
					<div class="formRow">
				<div class="cell">
					<label class="date">: משקפיים</label>
					<input type="checkbox" role="button" id="glasses" name="glasses" value="1" {$glasses} style="margin:4px 4px 0px 0px;" />
				</div>
			</div>
			</div>
			<h3>מבנה גוף</h3>
			<div class="formRow">
				<div class="cell">
					<label for="height">:גובה</label>
					<input type="text" id="height" name="height" value="{$height}"/>
				</div>
				<div class="cell">
					<label for="fabric">:מבנה גוף</label>
					<input type="text" id="fabric" name="fabric" value="{$fabric}"/>
				</div>
			</div>
		
		<div class="formRow">			
			<div class="cell">
					<label for="generalLook">:מראה כללי</label>
					<textarea id="generalLook" name="generalLook"  style="width:336px;height:50px;">{$generalLook}</textarea>
			</div>
		</div>
		<div class="buttons">
		<button role="button" onClick="submit_form('look','exit');"><span>שמור וצא</span></button>
		<button role="button" onClick="submit_form('look','next');"><span>שמור והמשך</span></button>
		
	</div>
		</form>		