<?php /* Smarty version 2.6.18, created on 2011-10-06 01:53:35
         compiled from list.tpl */ ?>
	<h3>���������� ������ �������</h3>
	<br />
	<div class="select-users-list">
	<form action="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
result.php" method="post" >
	<div class="stable">
		<label for='age'>���:</label>
		<span class="text">���</span><input type="text" size="2" id="age_from" name="age_from" />
		<span class="text">�</span><input type="text" size="2" id="age_to" name="age_to" />
	</div>
	<div class="stable gender">
		<label for="gender">����:</label>
		<select id="gender" name="gender">
			<option value=""></option>
			<option value="male">���</option>
			<option value="female">����</option>
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
		<button role="button">��� ������</button>
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