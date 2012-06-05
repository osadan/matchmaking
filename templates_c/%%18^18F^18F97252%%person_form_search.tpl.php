<?php /* Smarty version 2.6.18, created on 2011-10-06 02:19:28
         compiled from person_form_search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'candidate', 'person_form_search.tpl', 66, false),)), $this); ?>
<div class='container search-container'>
	<div class="right-sidebar search-bar">
		<form id='search-form' name='search-form' action='candidate.php' method='post'>
		<input type='hidden' name='search_gender' id='search_gender' value='<?php echo $this->_tpl_vars['search_gender']; ?>
' />
		<input type='hidden' name='type' id='type' value='search' />
		<input type="hidden" value="<?php echo $this->_tpl_vars['main_id']; ?>
" name="id" id="id"/>
		<div class='search-group'>
			<div class='search-group-title'>
				<h4>פרטים כללים</h4>
				<div class='search-group-collapse-icon on'>
				&#9650;
				</div>
			</div>
			<div class='search-group-content'>
				<div>
					<label for='general'>חיפוש כללי:</label>
					<input type='text' name='general' id='general' />
				</div>
				<div class="stable">
					<span  class='text'>גיל:</span>
					<span class="text">בין</span><input type="text" size="2" id="age_from" name="age_from" />
					<span class="text">ל</span><input type="text" size="2" id="age_to" name="age_to" />
				</div>
				<div>
					<label for='general'>מחותנים:</label>
					<input type='text' name='relatives' id='relatives' />
				</div>
				<div>
					<label for='general'>מוסדות לימוד:</label>
					<input type='text' name='institutions' id='institutions' />
				</div>
				<input type="button" name="" value="חפש" />
			</div>
			
		</div>
		
		<?php $_from = $this->_tpl_vars['search_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item_name'] => $this->_tpl_vars['def_arr']):
        $this->_foreach['outer']['iteration']++;
?>
			<?php if ($this->_tpl_vars['def_arr']['item_view_name'] != ""): ?>
				<div class='search-group'>
					<div class='search-group-title'>
						<h4><?php echo $this->_tpl_vars['def_arr']['item_view_name']; ?>
</h4>
						<div class='search-group-collapse-icon off'>
						&#9660;
						</div>
					</div>
					<div class='search-group-content' style='display:none'>
				<?php $_from = $this->_tpl_vars['def_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['inner'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['inner']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['inner']['iteration']++;
?>
					<?php if ($this->_tpl_vars['key'] != 'item_view_name'): ?>
						<div>
							<input type='checkbox' value='<?php echo $this->_tpl_vars['key']; ?>
' name='def_<?php echo $this->_tpl_vars['key']; ?>
' id='<?php echo $this->_tpl_vars['item_name']; ?>
<?php echo $this->_tpl_vars['key']; ?>
' />
							<label class='inline'><?php echo $this->_tpl_vars['value']; ?>
</label>
						</div>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
						<input type="button" name="" value="חפש" />
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</form>
	</div>
	<div  class="left-sidebar">
		<div class='candidate-list-wrapper'>
			<ul>
				<?php $_from = $this->_tpl_vars['candidates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['candidates'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['candidates']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['candidate_item']):
        $this->_foreach['candidates']['iteration']++;
?>
					<?php echo show_candidate_details_short(array('item' => $this->_tpl_vars['candidate_item'],'person_id' => $this->_tpl_vars['main_id'],'person_gender' => $this->_tpl_vars['search_gender']), $this);?>

				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	</div>
</div>
<?php echo '
<script>
	$(function(){
			$(".search-group-collapse-icon").click(function (){
					search.toggle_group(this);
				});
			$(".search-group input[type=button]").click(function (){
					search.search_submit();
				});
			$(".candidate-header").click(function(){
				$(this).find(\'.ui-icon\').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
				$(this).parents(".candidate:first").find(".candidate-content").slideToggle();
				
			}).find(".ui-icon").css("float","left");
			$(".candidate-content.candidate-search").css(\'display\',\'none\');
		});
</script>
'; ?>