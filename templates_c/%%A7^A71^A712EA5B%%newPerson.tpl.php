<?php /* Smarty version 2.6.18, created on 2012-06-06 00:26:44
         compiled from newPerson.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'institution_list', 'newPerson.tpl', 38, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
	var open_tab = 0;
    $("#tabs").tabs({cache:true ,
   		select: function (event,ui){
			if (ui.index != 0 && $("#frmMainDetails input[name=\'id\']").val() == false){
				if( $("#frmMainDetails").valid() ){
					$("#frmMainDetails").submit();
				}
				//return submit_form(\'frmMainDetails\',\'next\');
				return false;
			}
		}
    });
	 $("button").button();
	'; ?>

		<?php echo $this->_tpl_vars['open_tab']; ?>

	<?php echo '
	 
	 +function(){
		$("#tabs").tabs(\'select\',open_tab);
		var selected = $(\'#tabs\').tabs(\'option\', \'selected\');
		setFocus(selected);
	}();
	$(\'#tabs\').bind(\'tabsshow\', function(event, ui) {
		setFocus(ui.index);
	 });
	compare_age_input_init(\'year\',\'age\','; ?>
<?php echo $this->_tpl_vars['this_jewish_year']; ?>
<?php echo ');
	$(\'.user-operation-ribbon .ui-icon-person\').bind(\'click mouseover\',function(){
		
		$(\'.ribbon-content\').slideToggle();
		
	});

});
'; ?>

	<?php echo get_all_institutions_list(array(), $this);?>
	
<?php echo '	
 
  </script>
'; ?>

<!-- TODO  Add the time of the last update on update mode-->
<div id="tabs">
	<?php if ($this->_tpl_vars['firstName']): ?>
		<div class='candidate-page-title'>
			<h2> <?php echo $this->_tpl_vars['firstName']; ?>
 <?php echo $this->_tpl_vars['lastName']; ?>
</h2>
			<div class='user-operation-ribbon'>
				<span class='ui-icon ui-icon-person'></span>
				<div class='ribbon-canvas'>
					<div class='ribbon-content'>

						<div><a class='link remove-user'>הסר משתמש</a></div>

					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
    <ul class='person-nev'>
        <li><a href="#fragment-1"><span>פרטים אישיים</span></a></li>
        <li><a href="#fragment-2"><span>מראה חיצוני</span></a></li>
        <li><a href="#fragment-3"><span>נתוני סביבה</span></a></li>
		<li><a href="#fragment-4"><span>חיפוש</span></a></li>
		<li><a id='offers-meetings' href="#fragment-5"><span>הצעות/פגישות</span></a></li>
    </ul>
	
    <div id="fragment-1" class='tab'>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "person_form_details.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
    <div id="fragment-2" class='tab'>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "person_form_extrnal.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
	
    <div id="fragment-3" class='tab'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "person_form_env.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div id="fragment-4" class='tab'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "person_form_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div id='fragment-5' class='tab'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "person_form_mettings.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>