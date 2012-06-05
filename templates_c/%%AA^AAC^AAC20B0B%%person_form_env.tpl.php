<?php /* Smarty version 2.6.18, created on 2011-10-06 02:19:28
         compiled from person_form_env.tpl */ ?>
	<?php echo '
	<script>
	var cAdv = 3;var cRel= 3;var cInt = 3;
	function addTableRow(type)
	{
		switch(type)
		{
			case \'adv\' :
				cAdv++;
				$("#tbl_adv").append("<tr><td><input type=\'text\' name=\'adv_name"+ cAdv +"\'  id=\'adv_name"+ cAdv +"\' /></td><td><input type=\'text\' name=\'adv_relate"+ cAdv +"\'  id=\'adv_relate"+ cAdv +"\' /></td><td><input type=\'text\' name=\'adv_phone"+ cAdv +"\' id=\'adv_phone"+ cAdv +"\' /></td><td><input type=\'text\' name=\'adv_address"+ cAdv +"\'  id=\'adv_address"+ cAdv +"\' /></td><td><input type=\'text\' name=\'adv_work"+ cAdv +"\'  id=\'adv_work"+ cAdv +"\' /></td><td><textarea name=\'adv_recommand"+ cAdv +"\'  id=\'adv_recommand"+ cAdv +"\' class=\'multyline\' ></textarea></td></tr>");
				$("#count_adv").val(cAdv); 				
				break;
			case \'inst\':
				cInt++;
				$("#tbl_inst").append(\'<tr><td><input class="institution_name"  type="text" id="inst_name\' + cInt + \'" name="inst_name\' + cInt + \'" /></td><td><input type="text" id="inst_from\' + cInt + \'" name="inst_from\' + cInt + \'" /></td><td><input type="text" id="inst_to\' + cInt + \'" name="inst_to\' + cInt + \'" /></td><td><textarea id="inst_comment\' + cInt + \'" name="inst_comment\' + cInt + \'"></textarea></td></tr>\');
				$("#count_inst").val(cInt) ;
				$(\'#inst_name\' + cInt).autocomplete({
					source: institutions_list
				});
				break;
			case	\'rel\':
				cRel++;
				$("#tbl_rel").append(\'<tr><td><input type="text" id="rel_familyName\' + cRel + \'" name="rel_familyName\' + cRel + \'" /></td><td><input type="text" id="rel_type\' + cRel + \'" name="rel_type\' + cRel + \'" /></td><td><input type="text" id="rel_flow\' + cRel + \'" name="rel_flow\' + cRel + \'" /></td><td><input type="text" id="rel_work\' + cRel + \'" name="rel_work\' + cRel + \'" /></td><td><input type="text" id="rel_address\' + cRel + \'" name="rel_address\' + cRel + \'" /></td><td><input type="text" id="rel_phone\' + cRel + \'" name="rel_phone\' + cRel + \'" /></td><td><textarea id="rel_comment\' + cRel + \'" name="rel_comment\' + cRel + \'"> </textarea></td></tr>\');
				$("#count_rel").val(cRel);
				break;
		}
	}
	$(function(){
		$(\'.institution_name\').autocomplete({
			minLength: 2,
			source: institutions_list
		});
		});
	</script>
	'; ?>

	<form name="env" id="env" method="post" action="candidate.php">
				<input type="hidden" id="id3" name="id" value="<?php echo $this->_tpl_vars['main_id']; ?>
"/>
				<input type="hidden" id="type3" name="type" value="Enviorment"/>
				<input type="hidden" id="act3" name="act" value="<?php echo $this->_tpl_vars['act3']; ?>
"/>
				<input type="hidden" id="count_adv" name="count_adv" value="<?php if ($this->_tpl_vars['count_adv']): ?><?php echo $this->_tpl_vars['count_adv']; ?>
<?php else: ?>3<?php endif; ?>"/>
				<input type="hidden" id="count_inst" name="count_inst" value="<?php if ($this->_tpl_vars['count_inst']): ?><?php echo $this->_tpl_vars['count_inst']; ?>
<?php else: ?>3<?php endif; ?>"/>
				<input type="hidden" id="count_rel" name="count_rel" value="<?php if ($this->_tpl_vars['count_rel']): ?><?php echo $this->_tpl_vars['count_rel']; ?>
<?php else: ?>3<?php endif; ?>"/>
				
				<h3>ממליצים<a href="javascript:void(0);" onclick="addTableRow('adv');return false;">הוסף ממליץ</a></h3>
				<div class="multyDataCont">
					
					<ul>
					<li style='margin-left:39px;'><span class="required">*</span>שם/משפחה</li>
					<li style='margin-left:50px;'><span class="required">*</span>סוג קירבה</li>
					<li style='margin-left:42px;'>טלפון</li>
					<li style='margin-left:71px;'>כתובת</li>
					<li style='margin-left:75px'>תחום עיסוק</li>
					<li style=''>המלצה</li>
					</ul>
				<div class="scrollData">
				<table class="tblData" id="tbl_adv">
					<?php unset($this->_sections['adv_section']);
$this->_sections['adv_section']['name'] = 'adv_section';
$this->_sections['adv_section']['loop'] = is_array($_loop=$this->_tpl_vars['adv']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['adv_section']['start'] = (int)0;
$this->_sections['adv_section']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['adv_section']['show'] = true;
$this->_sections['adv_section']['max'] = $this->_sections['adv_section']['loop'];
if ($this->_sections['adv_section']['start'] < 0)
    $this->_sections['adv_section']['start'] = max($this->_sections['adv_section']['step'] > 0 ? 0 : -1, $this->_sections['adv_section']['loop'] + $this->_sections['adv_section']['start']);
else
    $this->_sections['adv_section']['start'] = min($this->_sections['adv_section']['start'], $this->_sections['adv_section']['step'] > 0 ? $this->_sections['adv_section']['loop'] : $this->_sections['adv_section']['loop']-1);
if ($this->_sections['adv_section']['show']) {
    $this->_sections['adv_section']['total'] = min(ceil(($this->_sections['adv_section']['step'] > 0 ? $this->_sections['adv_section']['loop'] - $this->_sections['adv_section']['start'] : $this->_sections['adv_section']['start']+1)/abs($this->_sections['adv_section']['step'])), $this->_sections['adv_section']['max']);
    if ($this->_sections['adv_section']['total'] == 0)
        $this->_sections['adv_section']['show'] = false;
} else
    $this->_sections['adv_section']['total'] = 0;
if ($this->_sections['adv_section']['show']):

            for ($this->_sections['adv_section']['index'] = $this->_sections['adv_section']['start'], $this->_sections['adv_section']['iteration'] = 1;
                 $this->_sections['adv_section']['iteration'] <= $this->_sections['adv_section']['total'];
                 $this->_sections['adv_section']['index'] += $this->_sections['adv_section']['step'], $this->_sections['adv_section']['iteration']++):
$this->_sections['adv_section']['rownum'] = $this->_sections['adv_section']['iteration'];
$this->_sections['adv_section']['index_prev'] = $this->_sections['adv_section']['index'] - $this->_sections['adv_section']['step'];
$this->_sections['adv_section']['index_next'] = $this->_sections['adv_section']['index'] + $this->_sections['adv_section']['step'];
$this->_sections['adv_section']['first']      = ($this->_sections['adv_section']['iteration'] == 1);
$this->_sections['adv_section']['last']       = ($this->_sections['adv_section']['iteration'] == $this->_sections['adv_section']['total']);
?>
					<?php $this->assign('k', $this->_sections['adv_section']['index']); ?>
					<?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
					<input type="hidden" name="adv_id<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['id']; ?>
" id="adv_id<?php echo $this->_tpl_vars['k']; ?>
" />
					<tr>
					<td><input type="text" name="adv_name<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['name']; ?>
" id="adv_name<?php echo $this->_tpl_vars['k']; ?>
" /></td>
					<td><input type="text" name="adv_relate<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['relate']; ?>
" id="adv_relate<?php echo $this->_tpl_vars['k']; ?>
" /></td>
					<td><input type="text" name="adv_phone<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['phone']; ?>
" id="adv_phone<?php echo $this->_tpl_vars['k']; ?>
" /></td>
					<td><input type="text" name="adv_address<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['address']; ?>
" id="adv_address<?php echo $this->_tpl_vars['k']; ?>
" /></td>
					<td><input type="text" name="adv_work<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['work']; ?>
" id="adv_work<?php echo $this->_tpl_vars['k']; ?>
" /></td>
					<td><textarea name="adv_recommand<?php echo $this->_tpl_vars['k']; ?>
"  id="adv_recommand<?php echo $this->_tpl_vars['k']; ?>
" class='multyline' ><?php echo $this->_tpl_vars['adv'][$this->_sections['adv_section']['index']]['recommand']; ?>
</textarea></td>
					</tr>
					<?php endfor; endif; ?>
				</table>
				</div>
				</div>
				<h3>מוסדות לימודיים<a href="javascript:void(0);" onclick="addTableRow('inst');return false;">הוסף מוסד לימודים</a></h3>
				<div class="multyDataCont">
					<ul>
						<li style='margin-left:49px'><span class="required">*</span>שם המוסד</li>
						<li style='margin-left:40px'>שנת התחלה</li>
						<li style='margin-left:56px'>שנת סיום</li>
						<li style=''>הערות</li>
					</ul>
					<div class="scrollData">
						<table class="tblData" id="tbl_inst">
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['inst']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)0;
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
						<?php $this->assign('j', $this->_sections['i']['index']); ?>
						<?php $this->assign('j', $this->_tpl_vars['j']+1); ?>
						<input type="hidden" name="inst_id<?php echo $this->_tpl_vars['j']; ?>
" value="<?php echo $this->_tpl_vars['inst'][$this->_sections['i']['index']]['id']; ?>
" id="inst_id<?php echo $this->_tpl_vars['j']; ?>
" />
						<tr>
						<td><input type="text" id="inst_name<?php echo $this->_tpl_vars['j']; ?>
" name="inst_name<?php echo $this->_tpl_vars['j']; ?>
" value="<?php echo $this->_tpl_vars['inst'][$this->_sections['i']['index']]['name']; ?>
" class="institution_name" /></td>
						<td><input type="text" id="inst_from<?php echo $this->_tpl_vars['j']; ?>
" name="inst_from<?php echo $this->_tpl_vars['j']; ?>
" value="<?php echo $this->_tpl_vars['inst'][$this->_sections['i']['index']]['from']; ?>
"/></td>
						<td><input type="text" id="inst_to<?php echo $this->_tpl_vars['j']; ?>
" name="inst_to<?php echo $this->_tpl_vars['j']; ?>
" value="<?php echo $this->_tpl_vars['inst'][$this->_sections['i']['index']]['to']; ?>
"/></td>
						<td><textarea id="inst_comment<?php echo $this->_tpl_vars['j']; ?>
" name="inst_comment<?php echo $this->_tpl_vars['j']; ?>
"><?php echo $this->_tpl_vars['inst'][$this->_sections['i']['index']]['comment']; ?>
</textarea></td>
						</tr>
						<?php endfor; endif; ?>
						</table>
					</div>	
				</div>	
				<h3>מחותנים<a href="javascript:void(0);" onclick="addTableRow('rel');return false;">הוסף מחותנים</a></h3>
				<div class="multyDataCont">
				<ul>
					<li style='margin-left:43px;'><span class="required">*</span>שם משפחה</li>
					<li style='margin-left:48px;'><span class="required">*</span>סוג קירבה</li>
					<li style='margin-left:53px;'>שיוך מגזרי</li>
					<li style='margin-left:73px;'>עיסוק</li>
					<li style='margin-left:70px;'>כתובת</li>
					<li style='margin-left:77px;'>טלפון</li>
					<li style='margin-left:'>הערות</li>
				</ul>
					<div class="scrollData">
						<table class="tblData" id="tbl_rel">
						<?php unset($this->_sections['rel_section']);
$this->_sections['rel_section']['name'] = 'rel_section';
$this->_sections['rel_section']['loop'] = is_array($_loop=$this->_tpl_vars['rel']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rel_section']['start'] = (int)0;
$this->_sections['rel_section']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['rel_section']['show'] = true;
$this->_sections['rel_section']['max'] = $this->_sections['rel_section']['loop'];
if ($this->_sections['rel_section']['start'] < 0)
    $this->_sections['rel_section']['start'] = max($this->_sections['rel_section']['step'] > 0 ? 0 : -1, $this->_sections['rel_section']['loop'] + $this->_sections['rel_section']['start']);
else
    $this->_sections['rel_section']['start'] = min($this->_sections['rel_section']['start'], $this->_sections['rel_section']['step'] > 0 ? $this->_sections['rel_section']['loop'] : $this->_sections['rel_section']['loop']-1);
if ($this->_sections['rel_section']['show']) {
    $this->_sections['rel_section']['total'] = min(ceil(($this->_sections['rel_section']['step'] > 0 ? $this->_sections['rel_section']['loop'] - $this->_sections['rel_section']['start'] : $this->_sections['rel_section']['start']+1)/abs($this->_sections['rel_section']['step'])), $this->_sections['rel_section']['max']);
    if ($this->_sections['rel_section']['total'] == 0)
        $this->_sections['rel_section']['show'] = false;
} else
    $this->_sections['rel_section']['total'] = 0;
if ($this->_sections['rel_section']['show']):

            for ($this->_sections['rel_section']['index'] = $this->_sections['rel_section']['start'], $this->_sections['rel_section']['iteration'] = 1;
                 $this->_sections['rel_section']['iteration'] <= $this->_sections['rel_section']['total'];
                 $this->_sections['rel_section']['index'] += $this->_sections['rel_section']['step'], $this->_sections['rel_section']['iteration']++):
$this->_sections['rel_section']['rownum'] = $this->_sections['rel_section']['iteration'];
$this->_sections['rel_section']['index_prev'] = $this->_sections['rel_section']['index'] - $this->_sections['rel_section']['step'];
$this->_sections['rel_section']['index_next'] = $this->_sections['rel_section']['index'] + $this->_sections['rel_section']['step'];
$this->_sections['rel_section']['first']      = ($this->_sections['rel_section']['iteration'] == 1);
$this->_sections['rel_section']['last']       = ($this->_sections['rel_section']['iteration'] == $this->_sections['rel_section']['total']);
?>
						<?php $this->assign('l', $this->_sections['rel_section']['index']); ?>
						<?php $this->assign('l', $this->_tpl_vars['l']+1); ?>
						<input type="hidden" name="rel_id<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['id']; ?>
" id="rel_id<?php echo $this->_tpl_vars['l']; ?>
" />
						<tr>
						<td><input type="text" id="rel_familyName<?php echo $this->_tpl_vars['l']; ?>
" name="rel_familyName<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['familyName']; ?>
"/></td>
						<td><input type="text" id="rel_type<?php echo $this->_tpl_vars['l']; ?>
" name="rel_type<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['type']; ?>
"/></td>
						<td><input type="text" id="rel_flow<?php echo $this->_tpl_vars['l']; ?>
" name="rel_flow<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['flow']; ?>
"/></td>
						<td><input type="text" id="rel_work<?php echo $this->_tpl_vars['l']; ?>
" name="rel_work<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['work']; ?>
"/></td>
						<td><input type="text" id="rel_address<?php echo $this->_tpl_vars['l']; ?>
" name="rel_address<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['address']; ?>
"/></td>
						<td><input type="text" id="rel_phone<?php echo $this->_tpl_vars['l']; ?>
" name="rel_phone<?php echo $this->_tpl_vars['l']; ?>
" value="<?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['phone']; ?>
"/></td>
						<td><textarea id="rel_comment<?php echo $this->_tpl_vars['l']; ?>
" name="rel_comment<?php echo $this->_tpl_vars['l']; ?>
"> <?php echo $this->_tpl_vars['rel'][$this->_sections['rel_section']['index']]['comments']; ?>
</textarea></td>
						</tr>
						<?php endfor; endif; ?>
						</table>
					</div>
				</div>
				<div class="buttons">
					<button role="button" onClick="submit_form('env','exit');"><span>שמור וצא</span></button>
					<button role="button" onClick="submit_form('env','next');"><span>שמור והמשך</span></button>
				</div>
			</form>	