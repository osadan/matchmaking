{literal}
<script>
$(function(){
$("#frmMainDetails").validate({
	
	rules: {
		age: {range:[0,100]}
	},
	invalidHandler: function(form, validator) {
		$('.message').html('ישנה בעיה בשדות המסומנים באדום , סדר את התקלות בכדי שתוכל להמשיך');
	}
	
});

});
</script>
{/literal}
<form action="candidate.php" method="post" id="frmMainDetails" name="mainDetails">
		<input type="hidden" value="{$main_id}" name="id" id="id"/>
		<input type="hidden" value="{$act1}" name="act" id="act1"/>
		<input type="hidden" value="Details" name="type" id="type" />
		<h3>נתונים אישיים</h3>
		<div class="formRow">
			<div class="cell">
				<label for="lastName">:שם משפחה<span class='required'>*</span></label>
				<input type="text" name="lastName" id="lastName" value="{$lastName}" class='hebraw required' />
			</div>
				<div class="cell">
				<label for="firstName">:שם פרטי<span class='required'>*</span></label>
				<input type="text" name="firstName" id="firstName" value="{$firstName}"  class='hebraw required'/>
			</div>
			<div class="cell">	
				<label for="tid">:ת.ז</label>
				<input type="text" name="tid" id="tid" value="{$tid}" class='digits' class='digits'/>
			</div>
			<div class="cell">
				<label for="gender">:מגדר<span class='required'>*</span></label>
				<select id="gender" name="gender" class='required'>
					<option value=""></option>
					<option value="male">זכר</option>
					<option value="female">נקבה</option>
				</select>
			</div>	
		</div>
		<div class="formRow">
			<div class="cell">		
				<label for="dorYesharim">:דור ישרים</label>
				<input type="text" name="dorYesharim" id="dorYesharim" value="{$dorYesharim}" />
			</div>
			<div class="cell">
				<label>:תאריך לידה</label>
				<label class="h_date">:יום</label>
				<select class="h_date" id="day" name="day">
				{foreach from=$days key=k item=v}
				<option value="{$k}">{$v}</option>
				{/foreach}
				</select>
				<label class="h_date">:חודש</label>
				<select class="h_date" id="month" name="month">
				{foreach from=$month key=k item=v}
				<option value="{$k}">{$v}</option>
				{/foreach}
				</select>
				<label class="h_date">:שנה</label>
				<select  class="h_date" id="year" name="year">
					{foreach from=$year key=k item=v}
						<option value="{$k}">{$v}</option>
					{/foreach}
				</select>
				<script type="text/javascript">
					//{if $k == "1980" } selected="selected" {/if}
					//$("#year").val(1990);
				</script>
			</div>
			<div class="cell">
				<label for="age"><span class='required'>*</span>:גיל</label>
				<input type="text" name="age" id="age" value="{$age}" class="numValue digits required max" />
			</div>
			<!-- endlish date and also hebraw date -->
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="phone"><span class='required'>*</span>:טלפון</label>
				<input type="text" name="phone" id="phone" value="{$phone}" class='simple_phone required'/>
			</div>
			<div class="cell">
				<label for="cellPhone">:פלאפון</label>
				<input type="text" name="cellPhone" id="cellPhone" value="{$cellPhone}" class='simple_phone' />
			</div>
			<div class="cell">
				<label for="email">:אי-מייל</label>
				<input type="text" name="email" id="email" value="{$email}"  class='email'/>
			</div>	
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="accupation">:עיסוק נוכחי</label>
				<input type="text" name="accupation" id="accupation" value="{$accupation}" class="long" class='hebraw'/>
			</div>
		</div>
		<h3>משפחה</h3>
		<div class="formRow">
			<div class="cell">
				<label for="fatherName">:שם האב</label>
				<input type="text" name="fatherName" id="fatherName" value="{$fatherName}" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="fatherJob">:עיסוק האב</label>
				<input type="text" name="fatherJob" id="fatherJob" value="{$fatherJob}" class="long" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="fatherWork">:מקום עבודה/כולל</label>
				<input type="text" name="fatherWork" id="fatherWork" value="{$fatherWork}" class="long"  class='hebraw'/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="motherName">:שם האם</label>
				<input type="text" name="motherName" id="motherName" value="{$motherName}" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="motherLastName">:שם משפחה לפני החתונה</label>
				<input type="text" name="motherLastName" id="motherLastName" value="{$motherLastName}" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="motherJob">:עיסוק האם</label>
				<input type="text" name="motherJob" id="motherJob" value="{$motherJob}" class="long" class='hebraw'/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="sibiling">:מס. אחים</label>
				<input type="text" name="sibiling" id="sibiling" value="{$sibiling}" class='digits' />
			</div>
			<div class="cell">
				<label for="s_married">? נשואים</label>
				<input type="text" name="s_married" id="s_married" value="{$s_married}" class="numValue digits"/>
			</div>
			<div class="cell">
			<label for="flow">:זרם</label>
			<select id="flow" name="flow">
				<option value=""></option>
				{html_options options=$flows selected=$flow_id}
			</select>
			</div>
			<div class="cell">
				<label for="origin">:מוצא/חסידות</label>
				<input type="text" name="origin" id="origin" value="{$origin}" class="long" />
			</div>
		</div>
		<h3>כתובת</h3>
		<div class="formRow">
			<div class="cell">
				<label for="street">:רחוב</label>
				<input type="text" name="street" id="street" value="{$street}" class="long alphanumerichebraw" />
			</div>	
			<div class="cell">
				<label for="neighborhood">:שכונה</label>
				<input type="text" name="neighborhood" id="neighborhood" value="{$neighborhood}" class="long hebraw" />
			</div>
			</div>
			<div class="formRow">
			<div class="cell">
				<label for="city">:עיר</label>
				<input type="text" name="city" id="city" value="{$city}"  class='hebraw'/>
			</div>
			<div class="cell">
				<label for="country">:ארץ</label>
				<input type="text" name="country" id="country" value="{$country}"  class='hebraw'/>
			</div>	
		</div>
		
		<h3>: הערות</h3>
		<div class="fomrRow">
			<div class="cell">
			<label for="comments"></label>
			<textarea id="comments" name="comments" style="width:440px;height:120px;">{$comments}</textarea>
			</div>
		</div>
	<div class="buttons">
	
<!--	<button role="button" onclick="return submit_form('frmMainDetails','remove');"><span>מחק משתמש</span></button> -->
	<button role="button" onClick="return submit_form('frmMainDetails','next');"><span>שמור והמשך</span></button>
	<button role="button" onClick="return submit_form('frmMainDetails','exit');"><span>שמור וצא</span></button>
		
		
	<!-- 	<button role="button" onClick="submit_form('frmMainDetails','next');" disabled="disabled"><span>הוסף דומה</span></button>  -->
	</div>
	</form>