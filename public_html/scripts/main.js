function compare_age_input_init(select_box,input,heb_year)
{
	//var d = new Date();
	//var y = d.getFullYear();
	var y = heb_year;
	$('#' + select_box).change(function (){
		if($(this).val() > 0 ){	
			var age = y - $(this).val();
			$('#' + input).val(age);
		}else{
			$('#' + input).val("");
		}
	});
	$('#' + input).blur(function(){
		if($(this).val() != ""){
			var year = heb_year - $(this).val();
			$("#" + select_box).val(year);
		}else{
			$("#" + select_box).val(0);
		}
	});
}

function submit_form(form,type)
  {
	$("#" + form).append('<input type="hidden" id="mod" name="mod"  value="' + type + '" />');
	//if(validate_required()){
		return $("#".form).submit();
		//return true;
	//}else{
		//return false;
	//}
	
  }
  function validate_required()
  {
  	var fleg = true;
  	var msg = "";
  	if($("#lastName").val() == "" || $("#firstName").val() == "" || $("#gender").val() == ""  || $("#phone").val() == "" || $("#age").val() == "") {
  		fleg = false;	
  		$(".message").html("נא למלא את כל השדות המסומנים בכוכבית בשביל להמשיך בתהליך ההרשמה");	
  	}
  	return fleg;
  }
  function setGender(male)
  {
	if (male) {
		$(".female").hide();
		$(".male").show();
	}else{
		$(".female").show();
		$(".male").hide();
	}
	
  } 

function bindSelect(Rows)
  {
	for(i  = 0;i<Rows.length;i++)
	{
		if(Rows[i].selected != "")
		{
			$("#"+Rows[i].id).val(Rows[i].selected);
		}
	}
  }
  function bindCheckbox(Rows)
  {
	for(i=0;i<Rows.length;i++)
	{
		$("input#" + Rows[i].id).attr("checked",true);
	}
  }
  
  function delmsg()
  {
	$(".message").html("");
  }
 function login()
 {
	$("#dialog").dialog('open');
	var _top = (($(window).height() - $("#dialog").height()) /2) + "px";
	var _left  = (($(window).width() - $("#dialog").width()) /2) + "px";
	$("#dialog").parent("div").css("top",_top);
	$("#dialog").parent("div").css("left",_left);
 }
 function logout()
 {
	location.href = server_root + 'index.php?action=logout';
 }
 function alertMe(message){
	alert(message);
 }
 function confirmMe(message){
	return confirm(message);
 }
 function sendLogin(){
	if($("#loginName").val() == "" || $("#loginPassword").val() == "" ){
		$(".login_message").html("נא למלא את כל השדות בכדי להמשיך ברישום");
		return false;
	}else{
		$("#fLogin").append('<input type="hidden" value="login" name="action" />');
		return true;
	}
 }
 var search = {
		 toggle_group : function(group)
		 {
	 		$(group).parents(".search-group-title").next().slideToggle(400,function (){
	 		if ($(group).hasClass('on')){
	 			
	 			$(group).html("&#9660;");
	 		}else if ($(group).hasClass('off')){
	 			$(group).html("&#9650;");
	 		}
	 		$(group).toggleClass('on');
 			$(group).toggleClass('off');
	 		});
		 },
		 search_submit : function ()
		 {
			 $("#search-form").submit();
		 },
		 last_search : function (data,form)
		 {
			 
			 jQuery.each(data, function(key, val) {
				 $input = $("#"+ form + " input[name=" + key + "]"); 
				 if($input.is('input[type=checkbox]')){
					  $input.attr('checked',true);
					  $input.parents('.search-group').find('.search-group-collapse-icon').trigger('click');
				  }else if ($input.not('input[type=hidden]')){
					  console.log(key + "=" + val);
					  $input.val(val);
				  }
				  
				 
				});

 
		 }
		 
};
 /* manage fields functions */
 function fillTableValues(el)
 {
 	$.post(server_root + "ajax.php?give_me=DefanitionList",{"id":$(el).val()},function (data){
 		var json = eval("(" + data + ")");
 		setTable(json);
 		});
 	
 }
 function setTable(Rows)
 {
 	var str = "";
 	for(i=0;i<Rows.length;i++)
 	{
 		var id = Rows[i].id;
 		str +="<tr class='tr-edit' id='tr-edit" + id + "'><td class='el-name'>" + Rows[i].name+ "</td><td><a href='javascript:void(0);' onclick='showUpdate(" + id + ")'>ערוך</a>&nbsp;<a href='javascript:void(0);' onclick='deleteValue(" + id +")'>מחק</a></td></tr>";
 		str +="<tr class='tr-update' id='tr-update" + id + "'><td><input type='text' id='value" + id + "' name='value" + id + "' value='" + Rows[i].name + "'/><td><a href='javascript:void(0);' onclick='updateValue(" + id + ",\"" + Rows[i].name + "\")'>שמור</a><a href='javascript:void(0);' onclick='cancelAction(" + id + ")'>בטל</a></td></tr>";
 	}
 	$("#valuesDefanitions").html(str);
 }
 function showUpdate(id){
 	$("#tr-edit" + id).fadeOut(500,function(){
 		$("#tr-update" + id).fadeIn(500);
 	});
 }
 function updateValue(id,value){
 		var newValue = $("#value" + id).val();
 		if(value != newValue){
 			$.post(server_root + "ajax.php?give_me=updateDefanition",{"id":id,"value":newValue},function(data){
 				if(data == 1) {
 					alertMe("עידכון הנתון בוצע בהצלחה");
 					$("#tr-edit" + id + " td.el-name").html(newValue); 
 					cancelAction(id);
 				}else{
 					alertMe("העידכון לא נקלט בשל תקלה במערכת אנא צור קשר עם התמיכה");
 					}
 					
 			});
 		}else{
 			alertMe("הערך המבוקש שווה בערכו לערך הקודם");
 		}
 	}
 function cancelAction(id){
 	$("#tr-update" + id).fadeOut(500,function(){
 		$("#tr-edit" + id).fadeIn(500);
 	});
 }
 function deleteValue(id){
 	if(confirmMe("האם אתה בטוח שרצונך למחוק ערך זה?")){
 		$.post(server_root + "ajax.php?give_me=deleteDefanition",{"id":id},function (data){
 			$("#tr-edit" + id).remove();
 		});
 	}
 }
 function item_save()
 {
 	$.post(server_root + "ajax.php?give_me=newItem",$("#f_item").serialize(),function (data){
 		if (data != ""){
 			var result = data.split("@@@",2);
 			$("#items_combo1").append("<option value='" + result[0] + "'>" + result[1] + "</option>");
 			$("#f_item input[type=text]").each(function (){$(this).val("")});
 			$("#g_item_item").val("null");
 			alertMe ("ההגדרה נשמרה בהצלחה");
 		}
 	});
 }
 function defanition_save()
 {
 	if($("#items_combo1").val() != 0){
 		$.post(server_root + "ajax.php?give_me=newDefanition",$("#f_defanition").serialize(),function(data){
 			alertMe("הערך נשמר בהצלחה");
 				$("#defanition").val("");
 				fillTableValues($("#items_combo1"));
 				$("#items_combo2").val($("#items_combo1").val());
 			});
 	}
 	else{
 		alertMe("עליך לבחור ערך");
 	}
 }
 function save_offer(el,candidate_id,person_id,person_gender,server_root)
 {
	 var boy_id,girl_id ;
	 if (person_gender == 'male'){
		 boy_id = person_id;
		 girl_id = candidate_id;
	 }else if (person_gender == 'female'){
		 girl_id = person_id;
		 boy_id =  candidate_id;
	 }
	 
	 $.post(server_root + 'ajax.php',{'give_me':'new_offer','boy_id' : boy_id,'girl_id' : girl_id},function (data){
		 if (!isNaN(data.result) && data.result  > 0  ){
			 alertMe("ההצעה נרשמה בהצלחה");
			 $(el).attr("onclick",'');
			 $(el).text("הצעה נרשמה במערכת");
			 $("#offers-meetings").unbind('click');
			 $("#offers-meetings").bind('click',function(){
				 window.location.href = server_root + 'candidate.php?type=show_offers&id=' + person_id;
			 });
		 }else{
			 alertMe("חלה תקלה בעת ביצוע ההרשמה אנא התקשר לתמיכה \n או נסה שוב מאוחר יותר");
		 }
		 
		 
		 
	 },'json');
 }
 function setFocus(index)
 {
	switch(index){
		case 0 : 
			$("#lastName").focus();
		break;
		case 1:
			$("#bird").focus();
		break;
		case 2:
			$("#adv_name1").focus();
		break;
	}

 }
 
 function open_change_offer_status_dialog(title,type,text)
 {
 	$("#metting-comments-dialog").dialog('open');
	$("#metting-comments-dialog").parents('.ui-dialog').css('position','fixed');
	$("#metting-comments-dialog").parents('.ui-dialog').css('left','40%');
	$("#metting-comments-dialog").parents('.ui-dialog').css('top','25%');
	$("#metting-comments-dialog").dialog('option','title',title);	
	/*$("#metting-comments-dialog").parents('ui-dialog').css('position','fixed');*/
		
	 
 }
 
 function save_meeting(offer_id)
 {
	 $.post(server_root + 'ajax.php?give_me=new_meeting',($('#meeting_form-' +offer_id).serialize()),
			 function (data){
		 if (data.result > 0){
			 alertMe('הפעולה הושלמה בהצלחה');
			 $form = $('#meeting_form-' +offer_id);
			 form_data = $('#meeting_form-' + offer_id).serializeArray();
			 var json = "";
			 jQuery.each(form_data, function(){
			        jQuery.each(this, function(i, val){
			                if (i=="name") {
			                        json += '"' + val + '":';
			                } else if (i=="value") {
			                        json += '"' + val.replace(/"/g, '\\"') + '",';
			                }
			        });
			    });
			json = "{" + json.substring(0, json.length - 1) + "}"; 
			if ( $('#meeting-row' + data.result).length > 0){
				 $tr =  $('#meeting-row'+ data.result);
				// $tr.fadeOut(1000,function (){
					  $tr.find('.tbl-meeting-time').html($form.find('select[name="time"]').val());
					  $tr.find('.tbl-meeting-date').html( meeting_date_value(offer_id));
					  $tr.find('.tbl-meeting-place').html($form.find(':input[name="meeting_place"]').val());
					  $tr.find('.tbl-meeting-remarks').html($form.find('textarea[name="remarks"]').val());
					  
					 
					  $tr.find('.tbl-meeting-actions .edit-meeting').attr('onClick',"edit_meeting(" + json + ",false,true)" );
					//  $tr.fadeIn(1000);
				 //});
			 }else{
				 
				 $table = $('.tbl-meetings-table');
				 
				 $table.find('.header-row').after(
						 "<tr class='meeting-row' id='meeting-row" + data.result+ "'> " +
							"<td class='tbl-meeting-date'>" + meeting_date_value(offer_id) + "</td> " +
							"<td class='tbl-meeting-time'>" + $form.find('select[name="time"]').val() + "</td> " +
							"<td class='tbl-meeting-place'>" + $form.find(':input[name="meeting_place"]').val() + "</td> " +
							"<td class='tbl-meeting-remarks'>" + $form.find('textarea[name="remarks"]').val() + "</td> " +
							"<td class='tbl-meeting-actions'> " +
								"<button role='button' class='edit-meeting' onclick='edit_meeting(" + json + ",{\"m_id\" : \"" + data.result + "\"},true);return false;'>ערוך פגישה</button> " +
								"<button role='button' class='remove-meeting' onclick='remove_meeting(" + data.result + ");return false;'>הסר</button> " +
							"</td> " +
						"</tr>");	 
			}	
			$('#meeting-row' + data.result + " button").button();
			 $form.parent('div.add-new-meeting-form').slideUp(1000,function (){
					$link = $form.parent().siblings().first().find('.add-new-meeting'); 
					$link.find('.ui-icon').removeClass('ui-icon-minusthick').addClass('ui-icon-plusthick');
					$link.find('.add-new-meeting-text').text('הוסף פגישה');
				});
			 $form.find('input[name !="offer_id"],select,textarea').val('');
		 }else{
			 alertMe('חלה תקלה לא צפויה אנא נסה שנית מאוחר יותר');
		 }
	 		},'json');
	return false; 
 }
 function remove_meeting(m_id)
 {
	 if (confirmMe('האם אתה בטוח שברצונך למחוק את הפגישה ?')){
		 $.post(server_root + 'ajax.php?give_me=remove_meeting',{"m_id" :  m_id },function(data){
			 if (data.result > 0){
				 alertMe('הפעולה הושלמה בהצלחה');
				 $('#meeting-row' + m_id ).fadeOut('1000');
			 }else{
				 alertMe('חלה תקלה לא צפויה אנא נסה שנית מאוחר יותר');
			 }
		 },'json');
	 }else{
		 alertMe('פעולתך בוטלה');
	 }
	 
 }
 
 function meeting_date_value(offer_id)
 {
	 $form = $('#meeting_form-' + offer_id);
	 var year = $form.find("select[name='years'] option:selected").text();
	 var month = $form.find("select[name='month'] option:selected").text();
	 var days = $form.find("select[name='days'] option:selected").text();
	 return days + '\'' + ' ' + month + ' ' + year ;
 }
 function edit_meeting(vars,vars_b,type)
 {
	 $.extend(vars,vars_b);
	 if (type){
		 vars.meeting_date = {};
		 vars.meeting_date.days = vars.days;
		 vars.meeting_date.month = vars.month;
		 vars.meeting_date.years = vars.years;
		 vars.meeting_date.time = vars.time;
	 }
	 
	 $form = $("#meeting_form-" + vars.offer_id);
	 $form.find("input[name='meeting_place']").val(vars.meeting_place).focus();
	 $form.find("select[name='days']").val(vars.meeting_date.days);
	 $form.find("select[name='month']").val(vars.meeting_date.month);
	 $form.find("select[name='years']").val(vars.meeting_date.years);
	 $form.find("select[name='time']").val(vars.meeting_date.time);
	 $form.find("textarea[name='remarks']").val(vars.remarks);
	 if ($form.find('input#m_id').length > 0 ){
		 $form.find('input#m_id').val(vars.m_id);
	 }
	 else{
	 	$form.append("<input type='hidden' name='m_id' value='" + vars.m_id + "' id='m_id'/>");
 	}
	$form.parent('div.add-new-meeting-form').slideDown(1000,function (){
		$link = $form.parent().siblings().first().find('.add-new-meeting'); 
		$link.find('.ui-icon').removeClass('ui-icon-plusthick').addClass('ui-icon-minusthick');
		$link.find('.add-new-meeting-text').text('סגור');
	});
	 
 }
 
function set_report_pager()
{
	$('.reports-table-bar table:first tr:first a').click(function(e){
		$('form#shid-reports-pager').attr('action',$(this).attr('href'));
		$('form#shid-reports-pager').submit();
		return false;
	});
}

function global_search_init()
{
	$(".search-input-submit").button();
}

 /* end of manage fields functions */
 $(document).ready(function(){
	$("#dialog").dialog({autoOpen:false});
});
