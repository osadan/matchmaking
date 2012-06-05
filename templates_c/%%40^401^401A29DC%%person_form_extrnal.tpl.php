<?php /* Smarty version 2.6.18, created on 2011-10-06 02:19:28
         compiled from person_form_extrnal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'person_form_extrnal.tpl', 12, false),)), $this); ?>

	<form name="look" id="look" method="post" action="candidate.php">
			<input type="hidden" value="Look" name="type" id="type2" />
			<input type="hidden" value="<?php echo $this->_tpl_vars['main_id']; ?>
" name="id" id="id2"/>
			<input type="hidden" value="<?php echo $this->_tpl_vars['act2']; ?>
" name="act" id="act2"/>
			<h3>לבוש</h3>
			<div class="formRow">
				<div class="cell male">
					<label for="bird">:זקן</label>
					<select name="bird" id="bird">
						<option value=""></option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['birds'],'selected' => $this->_tpl_vars['bird_id']), $this);?>

					</select>
				</div>
				<div class="cell male">
					<label for="hat">:כובע</label>
					<select name="hat" id="hat">
						<option value=""></option>	
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['hats'],'selected' => $this->_tpl_vars['hat_id']), $this);?>
	
				</select>
				</div>
				<div class="cell male">
					<label for="suit">:חליפה</label>
					<select name="suit" id="suit">
						<option value=""></option>	
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['suits'],'selected' => $this->_tpl_vars['suit_id']), $this);?>
	
					</select>
				</div>
				<div class="cell male">
					<label for="sideburns">:פאות</label>
					<select name="sideburns" id="sideburns">
						<option value=""></option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sideburns'],'selected' => $this->_tpl_vars['sideburns_id']), $this);?>
	
					</select>
				</div>
				<div class="cell female">
					<label for="wigg ">: כיסוי ראש</label>
					<select name="wigg" id="wigg">
						<option value=""></option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['wiggs'],'selected' => $this->_tpl_vars['wigg_id']), $this);?>
	
					</select>
				</div>
				<div class="cell">
					<label for="outLook">:הופעה</label>
					<select name="outLook" id="outLook">
						<option value=""></option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['outLooks'],'selected' => $this->_tpl_vars['outLook_id']), $this);?>

					</select>
				</div>
					<div class="formRow">
				<div class="cell">
					<label class="date">: משקפיים</label>
					<input type="checkbox" role="button" id="glasses" name="glasses" value="1" <?php echo $this->_tpl_vars['glasses']; ?>
 style="margin:4px 4px 0px 0px;" />
				</div>
			</div>
			</div>
			<h3>מבנה גוף</h3>
			<div class="formRow">
				<div class="cell">
					<label for="height">:גובה</label>
					<input type="text" id="height" name="height" value="<?php echo $this->_tpl_vars['height']; ?>
"/>
				</div>
				<div class="cell">
					<label for="fabric">:מבנה גוף</label>
					<input type="text" id="fabric" name="fabric" value="<?php echo $this->_tpl_vars['fabric']; ?>
"/>
				</div>
			</div>
		
		<div class="formRow">			
			<div class="cell">
					<label for="generalLook">:מראה כללי</label>
					<textarea id="generalLook" name="generalLook"  style="width:336px;height:50px;"><?php echo $this->_tpl_vars['generalLook']; ?>
</textarea>
			</div>
		</div>
		<div class="buttons">
		<button role="button" onClick="submit_form('look','exit');"><span>שמור וצא</span></button>
		<button role="button" onClick="submit_form('look','next');"><span>שמור והמשך</span></button>
		
	</div>
		</form>		