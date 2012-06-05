<?php /* Smarty version 2.6.18, created on 2012-02-10 00:11:30
         compiled from person_form_details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'person_form_details.tpl', 143, false),)), $this); ?>
<?php echo '
<script>
$(function(){
$("#frmMainDetails").validate({
	
	rules: {
		age: {range:[0,100]}
	},
	invalidHandler: function(form, validator) {
		$(\'.message\').html(\'���� ���� ����� �������� ����� , ��� �� ������ ���� ����� ������\');
	}
	
});

});
</script>
'; ?>

<form action="candidate.php" method="post" id="frmMainDetails" name="mainDetails">
		<input type="hidden" value="<?php echo $this->_tpl_vars['main_id']; ?>
" name="id" id="id"/>
		<input type="hidden" value="<?php echo $this->_tpl_vars['act1']; ?>
" name="act" id="act1"/>
		<input type="hidden" value="Details" name="type" id="type" />
		<h3>������ ������</h3>
		<div class="formRow">
			<div class="cell">
				<label for="lastName">:�� �����<span class='required'>*</span></label>
				<input type="text" name="lastName" id="lastName" value="<?php echo $this->_tpl_vars['lastName']; ?>
" class='hebraw required' />
			</div>
				<div class="cell">
				<label for="firstName">:�� ����<span class='required'>*</span></label>
				<input type="text" name="firstName" id="firstName" value="<?php echo $this->_tpl_vars['firstName']; ?>
"  class='hebraw required'/>
			</div>
			<div class="cell">	
				<label for="tid">:�.�</label>
				<input type="text" name="tid" id="tid" value="<?php echo $this->_tpl_vars['tid']; ?>
" class='digits' class='digits'/>
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
				<input type="text" name="dorYesharim" id="dorYesharim" value="<?php echo $this->_tpl_vars['dorYesharim']; ?>
" />
			</div>
			<div class="cell">
				<label>:����� ����</label>
				<label class="h_date">:���</label>
				<select class="h_date" id="day" name="day">
				<?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<label class="h_date">:����</label>
				<select class="h_date" id="month" name="month">
				<?php $_from = $this->_tpl_vars['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<label class="h_date">:���</label>
				<select  class="h_date" id="year" name="year">
					<?php $_from = $this->_tpl_vars['year']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<script type="text/javascript">
					//<?php if ($this->_tpl_vars['k'] == '1980'): ?> selected="selected" <?php endif; ?>
					//$("#year").val(1990);
				</script>
			</div>
			<div class="cell">
				<label for="age"><span class='required'>*</span>:���</label>
				<input type="text" name="age" id="age" value="<?php echo $this->_tpl_vars['age']; ?>
" class="numValue digits required max" />
			</div>
			<!-- endlish date and also hebraw date -->
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="phone"><span class='required'>*</span>:�����</label>
				<input type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['phone']; ?>
" class='simple_phone required'/>
			</div>
			<div class="cell">
				<label for="cellPhone">:������</label>
				<input type="text" name="cellPhone" id="cellPhone" value="<?php echo $this->_tpl_vars['cellPhone']; ?>
" class='simple_phone' />
			</div>
			<div class="cell">
				<label for="email">:��-����</label>
				<input type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['email']; ?>
"  class='email'/>
			</div>	
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="accupation">:����� �����</label>
				<input type="text" name="accupation" id="accupation" value="<?php echo $this->_tpl_vars['accupation']; ?>
" class="long" class='hebraw'/>
			</div>
		</div>
		<h3>�����</h3>
		<div class="formRow">
			<div class="cell">
				<label for="fatherName">:�� ���</label>
				<input type="text" name="fatherName" id="fatherName" value="<?php echo $this->_tpl_vars['fatherName']; ?>
" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="fatherJob">:����� ���</label>
				<input type="text" name="fatherJob" id="fatherJob" value="<?php echo $this->_tpl_vars['fatherJob']; ?>
" class="long" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="fatherWork">:���� �����/����</label>
				<input type="text" name="fatherWork" id="fatherWork" value="<?php echo $this->_tpl_vars['fatherWork']; ?>
" class="long"  class='hebraw'/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="motherName">:�� ���</label>
				<input type="text" name="motherName" id="motherName" value="<?php echo $this->_tpl_vars['motherName']; ?>
" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="motherLastName">:�� ����� ���� ������</label>
				<input type="text" name="motherLastName" id="motherLastName" value="<?php echo $this->_tpl_vars['motherLastName']; ?>
" class='hebraw'/>
			</div>
			<div class="cell">
				<label for="motherJob">:����� ���</label>
				<input type="text" name="motherJob" id="motherJob" value="<?php echo $this->_tpl_vars['motherJob']; ?>
" class="long" class='hebraw'/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="sibiling">:��. ����</label>
				<input type="text" name="sibiling" id="sibiling" value="<?php echo $this->_tpl_vars['sibiling']; ?>
" class='digits' />
			</div>
			<div class="cell">
				<label for="s_married">? ������</label>
				<input type="text" name="s_married" id="s_married" value="<?php echo $this->_tpl_vars['s_married']; ?>
" class="numValue digits"/>
			</div>
			<div class="cell">
			<label for="flow">:���</label>
			<select id="flow" name="flow">
				<option value=""></option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['flows'],'selected' => $this->_tpl_vars['flow_id']), $this);?>

			</select>
			</div>
			<div class="cell">
				<label for="origin">:����/������</label>
				<input type="text" name="origin" id="origin" value="<?php echo $this->_tpl_vars['origin']; ?>
" class="long" />
			</div>
		</div>
		<h3>�����</h3>
		<div class="formRow">
			<div class="cell">
				<label for="street">:����</label>
				<input type="text" name="street" id="street" value="<?php echo $this->_tpl_vars['street']; ?>
" class="long alphanumerichebraw" />
			</div>	
			<div class="cell">
				<label for="neighborhood">:�����</label>
				<input type="text" name="neighborhood" id="neighborhood" value="<?php echo $this->_tpl_vars['neighborhood']; ?>
" class="long hebraw" />
			</div>
			</div>
			<div class="formRow">
			<div class="cell">
				<label for="city">:���</label>
				<input type="text" name="city" id="city" value="<?php echo $this->_tpl_vars['city']; ?>
"  class='hebraw'/>
			</div>
			<div class="cell">
				<label for="country">:���</label>
				<input type="text" name="country" id="country" value="<?php echo $this->_tpl_vars['country']; ?>
"  class='hebraw'/>
			</div>	
		</div>
		
		<h3>: �����</h3>
		<div class="fomrRow">
			<div class="cell">
			<label for="comments"></label>
			<textarea id="comments" name="comments" style="width:440px;height:120px;"><?php echo $this->_tpl_vars['comments']; ?>
</textarea>
			</div>
		</div>
	<div class="buttons">
	
<!--	<button role="button" onclick="return submit_form('frmMainDetails','remove');"><span>��� �����</span></button> -->
	<button role="button" onClick="return submit_form('frmMainDetails','next');"><span>���� �����</span></button>
	<button role="button" onClick="return submit_form('frmMainDetails','exit');"><span>���� ���</span></button>
		
		
	<!-- 	<button role="button" onClick="submit_form('frmMainDetails','next');" disabled="disabled"><span>���� ����</span></button>  -->
	</div>
	</form>