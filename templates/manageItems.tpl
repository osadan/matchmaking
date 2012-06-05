{literal}
<style>
	tr.tr-update{display:none;}
	#valuesDefanitions{}
	div.add_left{float:left}
	div.add_right{float:right}
	div.form{margin:10px 0px }
	hr{width:360px;}
	button.small{font-size:9px !important;}
	div.form select {font-size:12px;color:#393939}
	#f_item button {margin-top:10px;}
</style>
{/literal}
<div style="direction:rtl">
	<div class="form">
		<form name="f_item" id="f_item">
			<div class='item-def-title'>
				הגדר סוג ערך חדש
			</div>
			<div>
				<label for="item" class="block">שם תצוגה</label>
				<input type="text" id="f_item_item" name="item" value="" />
			</div>
			<div>
				<label for="item" class="block">שם ניהולי</label>
				<input type="text" id="d_item_item" name="var" value="" />
			</div>
			<div>
				<label for='gender' class="block">שיוך מגזרי</label>
				<select id="g_item_item" name="gender" >
					<option value="null">--שיוך מגזרי--</option>
					<option value="both">כללי</option>
					<option value="male">זכר</option>
					<option value="female">נקבה</option>
				</select>
			</div>
			<button role="button" onclick="item_save();return false;" class="small">שמור</button>
		</form>
	</div>
	<hr />
	<div class="form">
		<form name="f_defanition" id="f_defanition">
			<div>
				<div>
					<label for="select_items">בחר שיוך לערך</label>
					<select name="items" id="items_combo1">
						<option value="0">--בחר ערך--</option>
						{html_options values=$items_ids  output=$items_names}
					</select>
				</div>
				<div>
					<label for="defanition" class="block">הוסף לרשימת ערכים</label>
					<input type="text" id="defanition" name="defanition" value="" />
					<button role="button" onclick="defanition_save();return false;" class="small" >שמור</button>
				</div>
			</div>
		</form>
	</div>
	<hr/>
	<div class="form">
		<label>תצוגת ערכים</label>
		<select name="items" id="items_combo2" >
			<option value="0">--בחר ערך--</option>
			{html_options values=$items_ids  output=$items_names}
		</select>
		<table id="valuesDefanitions">
		</table>
	</div>
	
	
</div>

{literal}
<script>

$(document).ready(function (){
	$("button").button();
	setTable({/literal}{$data}{literal});
	$("#items_combo2").change(function(){fillTableValues(this)});
});
</script>
{/literal}