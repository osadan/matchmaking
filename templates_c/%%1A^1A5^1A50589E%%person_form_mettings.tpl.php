<?php /* Smarty version 2.6.18, created on 2011-10-06 02:19:28
         compiled from person_form_mettings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'candidate_expended', 'person_form_mettings.tpl', 35, false),)), $this); ?>
<?php echo '
	<script>
	$(function() {
		$(".meetings-tabs").tabs().addClass(\'ui-tabs-vertical ui-helper-clearfix\');
		$(".meetings-tabs li").removeClass(\'ui-corner-top\').addClass(\'ui-corner-left\');

		$(".candidate-header").click(function(){
			$(this).find(\'.ui-icon\').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
			$(this).next(".candidate-meetings-panel").slideToggle();
			
		}).find(\'.ui-icon\').css("float","left");
		

		$(".add-new-meeting").click(function (){
			$div_form = $(this).parent(\'div\').next(\'div.add-new-meeting-form\');  
			 $div_form.slideToggle(1000);
			 $(this).find(\'.ui-icon\').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
			 if ($(this).find(\'.ui-icon\').hasClass(\'ui-icon-plusthick\')){
				 $(this).find(\'.add-new-meeting-text\').text(\'הוסף פגישה\');
				 $div_form.find(\'form\').find(\'input[name !="offer_id"],select,textarea\').val(\'\');
				 }
			 else{
				 $(this).find(\'.add-new-meeting-text\').text(\'סגור\');	
				 }
			});
	});
	</script>
'; ?>

		
		
		<div class='person_form_meetings'>
		<?php $_from = $this->_tpl_vars['on_meetings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['meetings'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['meetings']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['m']):
        $this->_foreach['meetings']['iteration']++;
?>
			<?php if (($this->_foreach['meetings']['iteration'] <= 1) == true): ?>	<h3>פגישות</h3><?php endif; ?>
			<div>
					<?php echo show_canidate_expended(array('candidate' => $this->_tpl_vars['m'],'person_id' => $this->_tpl_vars['main_id'],'person_gender' => $this->_tpl_vars['search_gender'],'type' => 'meeting'), $this);?>

			</div>
		<?php endforeach; endif; unset($_from); ?>
		
		<?php $_from = $this->_tpl_vars['on_offers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['offers'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['offers']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['o']):
        $this->_foreach['offers']['iteration']++;
?>
			<?php if (($this->_foreach['offers']['iteration'] <= 1) == true): ?><h3>הצעות</h3><?php endif; ?>
			<div>
				<?php echo show_canidate_expended(array('candidate' => $this->_tpl_vars['o'],'person_id' => $this->_tpl_vars['main_id'],'person_gender' => $this->_tpl_vars['search_gender'],'type' => 'offers'), $this);?>

			</div>
		<?php endforeach; endif; unset($_from); ?>
		
		<?php $_from = $this->_tpl_vars['on_refused']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['refused'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['refused']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['r']):
        $this->_foreach['refused']['iteration']++;
?>
			<?php if (($this->_foreach['refused']['iteration'] <= 1) == true): ?><h3>הצעות שנדחו</h3><?php endif; ?>
			<div><?php echo $this->_tpl_vars['r']['firstName']; ?>
</div>
		<?php endforeach; endif; unset($_from); ?>
		
		</div>
		<div id='meeting-comments-dialog'>
			<textarea rows='5' cols='34' name='metting-comments-dialog' id='textarea-metting-comments-dialog'>
			</textarea>
		</div>
<?php echo '
<script>
var offer_stauts_title;
var process_type;
var offer_status_text;
	$(function(){
		
		
		$(\'#meeting-comments-dialog\').dialog({
			autoOpen:false,
			modal:true,
			position:\'center\',
			dialogClass: \'ui-widget-wrapper\',
			buttons:{ \'שמור\' : function(){
						$(this).dialog(\'close\');
					}					
				}
			});
	});
</script>
'; ?>
