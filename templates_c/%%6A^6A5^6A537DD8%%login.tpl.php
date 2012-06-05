<?php /* Smarty version 2.6.18, created on 2011-10-06 02:01:32
         compiled from login.tpl */ ?>

<div class="right-sidebar">
	<?php if ($this->_tpl_vars['user']->userid == null): ?>
		<div class="formContainer">
			<h4>כניסת משתמשים</h4>
			<form name='fLogin' id='fLogin' action="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
index.php" onsubmit="return sendLogin();">
			
			<div class='formRow'>
				<div class='cell'>
					<label for="loginName" style="" class="loginName"> :שם</label>
					<input type="text" id="loginName" name="loginName" class="loginNamev" />
				</div>
			</div>	
			<div class='formRow'>
				<div class='cell'>
					<label for="loginPassword">:סיסמא</label>
					<input type="password" id="loginPassword" name="loginPassword" />
				</div>
			</div>	
			<div class='formRow'>
				
				<div class='cell'>  
					<span class="login_message" ><?php echo $this->_tpl_vars['login_message']; ?>
</span>
					<input role='botton' type="submit" id="loginButton" name="loginButton" value="כניסה" />
				</div>
			</div>
			</form>
		</div>

<?php echo '
<script>
(function($){
	$("#loginButton").button();
	$("#fLogin input[type=\'text\']").blur(function (){$(\'.login_message\').html(\'\');});
})(jQuery);

</script>
'; ?>

<?php else: ?>
<?php echo '
<style>
	.right-sidebar {border-left:none !important;}
</style>
'; ?>

<?php endif; ?>
</div>