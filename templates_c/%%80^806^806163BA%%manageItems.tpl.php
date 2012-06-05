<?php /* Smarty version 2.6.18, created on 2012-01-05 11:30:06
         compiled from manageItems.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'manageItems.tpl', 48, false),)), $this); ?>
<?php echo '
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
'; ?>

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
						<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['items_ids'],'output' => $this->_tpl_vars['items_names']), $this);?>

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
			<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['items_ids'],'output' => $this->_tpl_vars['items_names']), $this);?>

		</select>
		<table id="valuesDefanitions">
		</table>
	</div>
	
	
</div>

<?php echo '
<script>

$(document).ready(function (){
	$("button").button();
	setTable('; ?>
<?php echo $this->_tpl_vars['data']; ?>
<?php echo ');
	$("#items_combo2").change(function(){fillTableValues(this)});
});
</script>
'; ?>