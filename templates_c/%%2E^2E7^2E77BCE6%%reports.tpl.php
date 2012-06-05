<?php /* Smarty version 2.6.18, created on 2011-10-06 02:56:15
         compiled from reports.tpl */ ?>
<div class='reports tab'>
	<div class='reports-bar' >
		<form action='<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
reports.php' method='post' name='reports_form' id='reports-form' >	
			<div class='formRow'>
				<div class='cell'>
					<label>בחר תצוגת דוח</label>
					<select name='select_report' id='select_report'>
						<option value='null'>----------בחר----------</option>
						<option value='0'>הצג מועמדים</option>
						<option value='1'>הצג פגישות מתוכננות</option>
						<option value='2'>הצג מועמדים שסגרו</option>
					</select>
				</div>
				<div class='cell'>
					<label>תאריך מ</label>
					<input type='text' name='date_from' id='date_from' value=''/>
				</div>
				<div class='cell'>
					<label>תאריך עד</label>
					<input type='text' name='date_to' id='date_to' value='' />
				</div>
				<div class='cell'>
					<input type='submit' role='button' name='show_reports' id='show_reports' value='הצג דוח נבחר' />
				</div>
			</div>
		</form>	
	</div>
	<div class='report-header'>
		<h3><?php echo $this->_tpl_vars['grid_header']; ?>
</h3>
	</div>
	<div class='reports-table-bar'>
		<?php echo $this->_tpl_vars['table']; ?>

	</div>
	<form name='shid-reports-pager' id='shid-reports-pager' method='post'>
		<input type="hidden" name='date_from' id='date_from-pager' value='<?php echo $this->_tpl_vars['date_from']; ?>
' />
		<input type="hidden" name='date_to' id='date_to-pager' value='<?php echo $this->_tpl_vars['date_to']; ?>
' />
		<input type="hidden" value="<?php echo $this->_tpl_vars['selected']; ?>
" name="select_report" id="select_report_pager" />
		<input type="hidden" value="" name="" id="" />
	</form>
</div>
<?php echo '
<script>
	$(function() {
		var dates =$( "#date_from,#date_to" ).datepicker({
			"dateFormat" : \'yy-mm-dd\',
			onSelect: function( selectedDate ) {
			var option = this.id == "date_from" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
		});
		 $(":input[type=\'submit\']").button();
		 set_report_pager();
		 //$("#select_report").val('; ?>
<?php echo $this->_tpl_vars['selected']; ?>
<?php echo ');
	});
	</script>

'; ?>