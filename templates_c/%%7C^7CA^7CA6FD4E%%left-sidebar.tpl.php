<?php /* Smarty version 2.6.18, created on 2011-10-06 02:34:59
         compiled from left-sidebar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'last_meetings', 'left-sidebar.tpl', 19, false),)), $this); ?>
<div class="left-sidebar">
		<div class='search-form'>	
			<form name='long_search' id='long-search' action='<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
result.php' method='post'>
				<input type='hidden' name='search_type' value='global-search' />
				<input type='text' name='search' id='search' class='search-input' />
				<input type='submit' id='submit' name='submit' value='חיפוש כללי' class='search-input-submit' />
			</form>
		</div>	
		<div style='clear:both;display:none;'>	
			
			<a href="#" class="img"></a>
			<a href="#" class="img"></a>
			<a href="#" class="img"></a>
			<a href="#" class="img" style="margin-right: 0px;"></a>
		</div>	
			<div id="left-column">
			
				<h2>פגישות קרובות</h2>
				<?php echo homepage_view_last_meeting(array('data' => $this->_tpl_vars['last_meetings']), $this);?>

			
			</div>
			
			<div id="right-column">
			
				<h2>מועמדים חדשים</h2>
				<ul>
				
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['id']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
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
				
					<li><strong><?php echo $this->_tpl_vars['firstName'][$this->_sections['i']['index']]; ?>
&nbsp; <?php echo $this->_tpl_vars['lastName'][$this->_sections['i']['index']]; ?>
&nbsp;<?php echo $this->_tpl_vars['age'][$this->_sections['i']['index']]; ?>
&nbsp;-&nbsp;&nbsp;<?php echo $this->_tpl_vars['phone'][$this->_sections['i']['index']]; ?>
</strong>
					<a href="candidate.php?id=<?php echo $this->_tpl_vars['id'][$this->_sections['i']['index']]; ?>
">עוד...</a></li>
				
			<?php endfor; else: ?>
			<div>
				אין נתונים כרגע במערכת
			</div>
			<?php endif; ?>
				</ul>
			
			</div>
			
			
		
		</div>
		<?php echo '
<style>
	#right-column ul li a{text-decoration:none;}
	#right-column ul li a:hover{color:crimson;}
</style>
<script>
	$(document).ready(function (){
		global_search_init();
		});
</script>
'; ?>