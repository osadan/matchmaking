<?php /* Smarty version 2.6.18, created on 2011-10-04 02:52:05
         compiled from users.tpl */ ?>
<?php echo '
<script>
function validateForm(){
	//alert("validating");
	var message = "";
	$("input").each(function(){if($(this).data("valid") == "required" && $(this).val() == "")
		message =  " ��� ��� �� �� ����� �������� ������� ";});
	if ($("#premmisions").val() == 0){
		message =  " ��� ��� �� �� ����� �������� ������� ";
	}
	if (message != "") {
		$(".message").append(message);
		return false;
	}else{
		if($(".message").data("nick") == "false"){
			$(".message").html(" ��� ���� ���� ��� ������ \\n ��� ��� ����� ��� ");
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
						$(".message").append(" ��� ���� ���� ��� ������ \\n ��� ��� ����� ��� ");
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
		<h3><?php if ($this->_tpl_vars['id'] == ""): ?>����� ����� ���<?php else: ?>����� ����� <a href="javascript:deleteUser();">����� �����</a><a href="javascript:changePassword();">����� �����</a><?php endif; ?></h3>
		<div class="formRow">
			<div class="cell">
				<label for="lastName">:�� �����<span class='required'>*</span></label>
				<input type="text" name="lastName" id="lastName" value="<?php echo $this->_tpl_vars['lastName']; ?>
" />
			</div>
				<div class="cell">
				<label for="firstName">:�� ����<span class='required'>*</span></label>
				<input type="text" name="firstName" id="firstName" value="<?php echo $this->_tpl_vars['firstName']; ?>
" />
			</div>
			</div>
			<div class="formRow">
			<div class="cell">
				<label for="nick">:�����<span class='required'>*</span></label>
				<input type="text" name="nickName" id="nickName" value="<?php echo $this->_tpl_vars['nickName']; ?>
" />
			</div>
			<?php if ($this->_tpl_vars['id'] == ""): ?>
			<div class="cell" >
				<label for="password">:�����<span class='required'>*</span></label>
				<input type="password" name="password" id="password" value="<?php echo $this->_tpl_vars['password']; ?>
" />
			</div>
			<?php endif; ?>
		</div>
		<div class='formRow'>
			<div class="cell">
				<label for="address">:�����</label>
				<input type="text" name="address" id="address" value="<?php echo $this->_tpl_vars['address']; ?>
" class="long"/>
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="phone">:�����</label>
				<input type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['phone']; ?>
" />
			</div>
			<div class="cell">
				<label for="cellphone">:������</label>
				<input type="text" name="cellphone" id="cellphone" value="<?php echo $this->_tpl_vars['cellphone']; ?>
" />
			</div>
		</div>
		<div class='formRow'>
			<div class="cell">
				<label for="email">:����� ����</label>
				<input type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['email']; ?>
" class="long" />
			</div>
		</div>
		<div class="formRow">
			<div class="cell">
				<label for="premmisions">:��� �����<span class='required'>*</span></label>
				<select type="text" name="premmisions" id="premmisions" value="<?php echo $this->_tpl_vars['premmisions']; ?>
" >
				<option value="0"></option>
				<option value="256">����</option>
				<option value="128">����</option>
				</select>
			</div>
		</div>
		<div style="clear:right;margin-top:10px;">
			<input type="submit" value="����" name="sub_mit" id="sub_mit" />
		</div>

		</div>
		</form>
		<form id="data" name="data" method="post">
			<input type="hidden" id="user_id_data" name="user_id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>
		</form>

