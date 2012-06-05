<?php /* Smarty version 2.6.18, created on 2011-10-05 23:21:44
         compiled from result.tpl */ ?>
<?php echo '
<script>
	$(function() {
		$("#sortable1, #sortable2").sortable({
			connectWith: \'.connectedSortable\'
		}).disableSelection();
		$(".candidate").find(".candidate-header").addClass("ui-widget-header ui-corner-all").prepend(\'<span class="ui-icon ui-icon-plusthick"></span>\').end().find(".portlet-content");
		$(".candidate-header").click(function(){
			$(this).find(\'.ui-icon\').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
			$(this).parents(".candidate:first").find(".candidate-content").slideToggle();
			
		}).find(\'.ui-icon\').css("float","left");
		$(".candidate-content").css(\'display\',\'none\');
		global_search_init();
	});
</script>
'; ?>

<div class='search-form'>	
			<form name='long_search' id='long-search' action='<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
result.php' method='post'>
				<input type='hidden' name='search_type' value='global-search' />
				<input type='text' name='search' id='search' class='search-input' value='<?php echo $this->_tpl_vars['search_value']; ?>
' />
				<input type='submit' id='submit' name='submit' value='חיפוש כללי' class='search-input-submit' />
			</form>
</div>
<ul id="sortable1" class="connectedSortable" >
	<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['id']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
	<li class="ui-state-default">
		<div class="candidate">
			<div class="candidate-header">
				<span class="headerText"><a href='<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
candidate.php?id=<?php echo $this->_tpl_vars['id'][$this->_sections['c']['index']]; ?>
' ><?php echo $this->_tpl_vars['firstName'][$this->_sections['c']['index']]; ?>
  <?php echo $this->_tpl_vars['lastName'][$this->_sections['c']['index']]; ?>
</a></span>
			</div>
			<div class="candidate-content">
				<div>
					<?php if ($this->_tpl_vars['street'][$this->_sections['c']['index']] != ""): ?>
						<span class="label">רחוב :</span><span class="desc"><?php echo $this->_tpl_vars['street'][$this->_sections['c']['index']]; ?>
</span>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['neighborhood'][$this->_sections['c']['index']] != ""): ?>
						<span class="label">שכונה :</span><span class="desc"><?php echo $this->_tpl_vars['neighborhood'][$this->_sections['c']['index']]; ?>
</span>
					<?php endif; ?>
				</div>
				<?php if ($this->_tpl_vars['city'][$this->_sections['c']['index']] != ""): ?>
				<div>
					<span class="label">עיר :</span><span class="desc"><?php echo $this->_tpl_vars['city'][$this->_sections['c']['index']]; ?>
</span>
				</div>
				<?php endif; ?>
				<div>
					<?php if ($this->_tpl_vars['phone'][$this->_sections['c']['index']] != ""): ?>
						<span class="label">טלפון :</span><span class="desc"><?php echo $this->_tpl_vars['phone'][$this->_sections['c']['index']]; ?>
</span>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['cellphone'][$this->_sections['c']['index']] != ""): ?>
						<span class="label">פלאפון :</span><span class="desc"><?php echo $this->_tpl_vars['cellphone'][$this->_sections['c']['index']]; ?>
</span>
					<?php endif; ?>
				</div>
				<div style="height:15px">
					<a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
candidate.php?id=<?php echo $this->_tpl_vars['id'][$this->_sections['c']['index']]; ?>
" target='_blank'>....עוד</a>
				</div>
			</div>
		</div>
	</li>
	<?php endfor; endif; ?>
</ul>
<ul id="sortable2" class="connectedSortable droptrue">

</ul>
<div>

</div>