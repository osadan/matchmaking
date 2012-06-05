<?php /* Smarty version 2.6.18, created on 2011-10-04 02:52:05
         compiled from users.tpl */ ?>
<?php echo '
<script>
function validateForm(){
	//alert("validating");
	var message = "";
	$("input").each(function(){if($(this).data("valid") == "required" && $(this).val() == "")
		message =  " אנא מלא את כל השדות המסומנים בכוכבית ";});
	if ($("#premmisions").val() == 0){
		message =  " אנא מלא את כל השדות המסומנים בכוכבית ";
	}
	if (message != "") {
		$(".message").append(message);
		return false;
	}else{
		if($(".message").data("nick") == "false"){
			$(".message").html(" כבר קיים כנוי כזה במערכת \\n אנא בחר כינוי אחר ");
			$("#nickName").focus().select();
			return false;
		}else{
			return true;
		}
	}
}
$(document).ready(function(){
		var nickname = $("#nickName").val(); 
		$("#lastName").focus();
		$(".message").data("nick","true");
		$("input").focus(function(){
			if($("#user_id").val() != "")
				$(this).select();
		});
		$("#nickName").change(function (){
			$.ajax({
				url:server_root+\'ajax.php\',
				data:"give_me=nick_compare&nickName=" + ($("#nickName").val()) ,
				success:function (data){
					if(data > 0 ){
						$(".message").append(" כבר קיים כנוי כזה במערכת \\n אנא בחר כינוי אחר ");
						$(".message").data("nick","false");
						$("#nickName").focus().select();//function(){$(this).select();}
					}else{
						$(".message").html("");
						$(".message").data("nick","true");
					}
				},
				type:"POST"
				//,contentType:"charset=Windows-1255"	
			});
		});
		if(! location.href.match("edit")){ 
			$("#lastName,#firstName,#nickName,#password").data("valid","required");
			}else{
				//alert ("edit");
			}
	});
function deleteUser()
{
	$("#data").attr(\'action\',"users.php?action=delete");
	$("#data").submit();
}
function changePassword()
{
	$("#data").attr(\'action\',"changePassword.php");
	$("#data").submit();
}
	</script>
<style>
.tab h3 a {color:crimson;float:none;margin-right:8px;}
.tab h3 a:hover{color:#5a9a5a}
</style>
'; ?>

		<form method="post" name="f_user" id="f_user" action="users.php" onSubmit="return validateForm();">
		<div class='tab' style="margin-right:27px;">
		<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
		<h3><?php if ($this->_tpl_vars['id'] == ""): ?>הוספת משתמש חדש<?php else: ?>עריכת משתמש <a href="javascript:deleteUser();">מחיקת משתמש</a><a href="javascript:changePassword();">שינוי סיסמא</a><?php endif; ?></h3>
		<div class="formRow">
			<div class="cell">
				<label for="lastName">:שם משפחה<span class='required'>*</span></label>
				<input type="text" name="lastName" id="lastName" value="<?php echo $this->_tpl_vars['lastName']; ?>
" />
			</div>
				<div class="cell">
				<label for="firstName">:שם פרטי<span class='required'>*</span></label>
				<input type="text" name="firstName" id="firstName" value="<?php echo $this->_tpl_vars['firstName']; ?>
" />
			</div>
			</div>
			<div class="formRow">
			<div class="cell">
				<label for="nick">:כינוי<span class='required'>*</span></label>
				<input type="text" name="nickName" id="nickName" value="<?php echo $this->_tpl_vars['nickName']; ?>
" />
			</div>
			<?php if ($this->_tpl_vars['id'] == ""): ?>
			<div class="cell" >
				<label for="password">:סיסמא<span class='required'>*</span></label>
				<input type="password" name="password" id="password" value="<?php echo $this->_tpl_vars['password']; ?>
" />
			</div>
			<?php endif; ?>
		</div>
		<div class='formRow'>
			<div class="cell">
				<label for="address">:כתובת</label>
				<input type="text" name="address" id="address" value="<?php echo $this->_tpl_vars['address']; ?>
" class="long"/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="phone">:טלפון</label>
				<input type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['phone']; ?>
" />
			</div>
			<div class="cell">
				<label for="cellphone">:פלאפון</label>
				<input type="text" name="cellphone" id="cellphone" value="<?php echo $this->_tpl_vars['cellphone']; ?>
" />
			</div>
		</div>
		<div class='formRow'>
			<div class="cell">
				<label for="email">:כתובת מייל</label>
				<input type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['email']; ?>
" class="long" />
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="premmisions">:סוג הרשאה<span class='required'>*</span></label>
				<select type="text" name="premmisions" id="premmisions" value="<?php echo $this->_tpl_vars['premmisions']; ?>
" >
				<option value="0"></option>
				<option value="256">מנהל</option>
				<option value="128">עורך</option>
				</select>
			</div>
		</div>
		<div style="clear:right;margin-top:10px;">
			<input type="submit" value="שמור" name="sub_mit" id="sub_mit" />
		</div>

		</div>
		</form>
		<form id="data" name="data" method="post">
			<input type="hidden" id="user_id_data" name="user_id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>
		</form>

