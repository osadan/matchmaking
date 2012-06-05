
<div class="right-sidebar">
	{if $user->userid == null}
		<div class="formContainer">
			<h4>כניסת משתמשים</h4>
			<form name='fLogin' id='fLogin' action="{$SERVER_ROOT}index.php" onsubmit="return sendLogin();">
			
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
					<span class="login_message" >{$login_message}</span>
					<input role='botton' type="submit" id="loginButton" name="loginButton" value="כניסה" />
				</div>
			</div>
			</form>
		</div>

{literal}
<script>
(function($){
	$("#loginButton").button();
	$("#fLogin input[type='text']").blur(function (){$('.login_message').html('');});
})(jQuery);

</script>
{/literal}
{else}
{literal}
<style>
	.right-sidebar {border-left:none !important;}
</style>
{/literal}
{/if}
</div>