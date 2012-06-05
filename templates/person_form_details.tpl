{literal}
<script>
$(function(){
$("#frmMainDetails").validate({
	
	rules: {
		age: {range:[0,100]}
	},
	invalidHandler: function(form, validator) {
		$('.message').html('���� ���� ����� �������� ����� , ��� �� ������ ���� ����� ������');
	}
	
});

});
</script>
{/literal}
<form action="candidate.php" method="post" id="frmMainDetails" name="mainDetails">
		<input type="hidden" value="{$main_id}" name="id" id="id"/>
		<input type="hidden" value="{$act1}" name="act" id="act1"/>
		<input type="hidden" value="Details" name="type" id="type" />
		<h3>������ ������</h3>
		<div class="formRow">
			<div class="cell">
				<label for="lastName">:�� �����<span class='required'>*</span></label>
				<input type="text" name="lastName" id="lastName" value="{$lastName}" class='hebraw required' />
			</div>
				<div class="cell">
				<label for="firstName">:�� ����<span class='required'>*</span></label>
				<input type="text" name="firstName" id="firstName" value="{$firstName}"  class='hebraw required'/>
			</div>
			<div class="cell">	
				<label for="tid">:�.�</label>
				<input type="text" name="tid" id="tid" value="{$tid}" class='digits' class='digits'/>
			</div>
			<div class="cell">
				<label for="gender">:����<span class='required'>*</span></label>
				<select id="gender" name="gender" class='required'>
					<option value=""></option>
					<option value="male">���</option>
					<option value="female">����</option>
				</select>
			</div>	
		</div>
		<div class="formRow">
			<div class="cell">		
				<label for="dorYesharim">:��� �����</label>
				<input type="text" name="dorYesharim" id="dorYesharim" value="{$dorYesharim}" />
			</div>
			<div class="cell">
				<label>:����� ����</label>
				<label class="h_date">:���</label>
				<select class="h_date" id="day" name="day">
				{foreach from=$days key=k item=v}
				<option value="{$k}">{$v}</option>
				{/foreach}
				</select>
				<label class="h_date">:����</label>
				<select class="h_date" id="month" name="month">
				{foreach from=$month key=k item=v}
				<option value="{$k}">{$v}</option>
				{/foreach}
				</select>
				<label class="h_date">:���</label>
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
				<label for="age"><span class='required'>*</span>:���</label>
				<input type="text" name="age" id="age" value="{$age}" class="numValue digits required max" />
			</div>
			<!-- endlish date and also hebraw date -->
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="phone"><span class='required'>*</span>:�����</label>
				<input type="text" name="phone" id="phone" value="{$phone}" class='simple_phone required'/>
			</div>
			<div class="cell">
				<label for="cellPhone">:������</label>
				<input type="text" name="cellPhone" id="cellPhone" value="{$cellPhone}" class='simple_phone' />
			</div>
			<div class="cell">
				<label for="email">:��-����</label>
				<input type="text" name="email" id="email" value="{$email}"  class='email'/>
			</div>	
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="accupation">:����� �����</label>
				<input type="text" name="accupation" id="accupation" value="{$accupation}" class="long" class='hebraw'/>
			</div>
		</div>
		<h3>�����</h3>
		<div class="formRow">
			<div class="cell">
				<label for="fatherName">:�� ���</label>
				<input type="text" name="fatherName" id="fatherName" value="{$fatherName}" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="fatherJob">:����� ���</label>
				<input type="text" name="fatherJob" id="fatherJob" value="{$fatherJob}" class="long" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="fatherWork">:���� �����/����</label>
				<input type="text" name="fatherWork" id="fatherWork" value="{$fatherWork}" class="long"  class='hebraw'/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="motherName">:�� ���</label>
				<input type="text" name="motherName" id="motherName" value="{$motherName}" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="motherLastName">:�� ����� ���� ������</label>
				<input type="text" name="motherLastName" id="motherLastName" value="{$motherLastName}" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="motherJob">:����� ���</label>
				<input type="text" name="motherJob" id="motherJob" value="{$motherJob}" class="long" class='hebraw'/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="sibiling">:��. ����</label>
				<input type="text" name="sibiling" id="sibiling" value="{$sibiling}" class='digits' />
			</div>
			<div class="cell">
				<label for="s_married">? ������</label>
				<input type="text" name="s_married" id="s_married" value="{$s_married}" class="numValue digits"/>
			</div>
			<div class="cell">
			<label for="flow">:���</label>
			<select id="flow" name="flow">
				<option value=""></option>
				{html_options options=$flows selected=$flow_id}
			</select>
			</div>
			<div class="cell">
				<label for="origin">:����/������</label>
				<input type="text" name="origin" id="origin" value="{$origin}" class="long" />
			</div>
		</div>
		<h3>�����</h3>
		<div class="formRow">
			<div class="cell">
				<label for="street">:����</label>
				<input type="text" name="street" id="street" value="{$street}" class="long alphanumerichebraw" />
			</div>	
			<div class="cell">
				<label for="neighborhood">:�����</label>
				<input type="text" name="neighborhood" id="neighborhood" value="{$neighborhood}" class="long hebraw" />
			</div>
			</div>
			<div class="formRow">
			<div class="cell">
				<label for="city">:���</label>
				<input type="text" name="city" id="city" value="{$city}"  class='hebraw'/>
			</div>
			<div class="cell">
				<label for="country">:���</label>
				<input type="text" name="country" id="country" value="{$country}"  class='hebraw'/>
			</div>	
		</div>
		
		<h3>: �����</h3>
		<div class="fomrRow">
			<div class="cell">
			<label for="comments"></label>
			<textarea id="comments" name="comments" style="width:440px;height:120px;">{$comments}</textarea>
			</div>
		</div>
	<div class="buttons">
	
<!--	<button role="button" onclick="return submit_form('frmMainDetails','remove');"><span>��� �����</span></button> -->
	<button role="button" onClick="return submit_form('frmMainDetails','next');"><span>���� �����</span></button>
	<button role="button" onClick="return submit_form('frmMainDetails','exit');"><span>���� ���</span></button>
		
		
	<!-- 	<button role="button" onClick="submit_form('frmMainDetails','next');" disabled="disabled"><span>���� ����</span></button>  -->
	</div>
	</form>