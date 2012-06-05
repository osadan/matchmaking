<?php /* Smarty version 2.6.18, created on 2011-10-06 01:53:35
         compiled from list.tpl */ ?>
	<h3>קריטריונים לתצוגת מועמדים</h3>
	<br />
	<div class="select-users-list">
	<form action="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
result.php" method="post" >
	<div class="stable">
		<label for='age'>גיל:</label>
		<span class="text">בין</span><input type="text" size="2" id="age_from" name="age_from" />
		<span class="text">ל</span><input type="text" size="2" id="age_to" name="age_to" />
	</div>
	<div class="stable gender">
		<label for="gender">מגדר:</label>
		<select id="gender" name="gender">
			<option value=""></option>
			<option value="male">זכר</option>
			<option value="female">נקבה</option>
		</select>
	</div>
	<div class="stable">
		<table><tr><td class="Attri">
			<script>
				document.write(moreCombo());
			</script>
		</td><td class="Details">
			<script>
				document.write(moreDetails());
			</script>
		</td></tr></table>
	</div>
	<div class="submit">
		<button role="button">הצג תוצאות</button>
	</div>
	</form>
	</div>
	<?php echo '
<script>
	$(document).ready(function(){
		$("button").button();
		$("#age_from").focus();
	});
</script>
'; ?>