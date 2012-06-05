{literal}
	<style>
		#changePassword{width:220px;margin:10px auto;border: 1px solid #942829;padding:5px;height:125px;}
		#changePassword label {float:right;margin-left:3px;}
		#changePassword label span{float:left;}
		#changePassword input[type="text"] {width:145px;float:left;}
		/*.tab {text-align:center;}*/
		#changePassword h3 {margin-bottom:3px;}
	</style>
	<script>
	function validPassForm()
	{
		var result = true;	
		$(":text").each(function(){
			if($(this).val() == ""){
				$('.message').html("אנא וודא שכל השדות מלאים");
				result =  false;
			}
		});
		return result;
	}
	$(document).ready(function(){
		$(":text").focus(function (){$(".message").html("");});
	});
	</script>
{/literal}
<div id="changePassword">
	<form action="changePassword.php" method="post" onSubmit="return validPassForm();" >
		<div class="tab">
		<h3>שינוי סיסמא</h3>
			<input type="hidden" id="user_id" name="user_id" value="{$user_id}" />
			<label><span>סיסמא ישנה</span></label><input type="text" value="" id="old" name="old" /><br /><br />
			<label><span>סיסמא חדשה</span></label><input type="text" value="" id="new" name="new" />
			<div style="clear:both;height:5px;"></div>
			<input type="submit" value="שמור" name="sub_mit" id="sub_mit" />
		</div>
	</form>
</div>	
