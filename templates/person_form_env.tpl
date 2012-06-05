	{literal}
	<script>
	var cAdv = 3;var cRel= 3;var cInt = 3;
	function addTableRow(type)
	{
		switch(type)
		{
			case 'adv' :
				cAdv++;
				$("#tbl_adv").append("<tr><td><input type='text' name='adv_name"+ cAdv +"'  id='adv_name"+ cAdv +"' /></td><td><input type='text' name='adv_relate"+ cAdv +"'  id='adv_relate"+ cAdv +"' /></td><td><input type='text' name='adv_phone"+ cAdv +"' id='adv_phone"+ cAdv +"' /></td><td><input type='text' name='adv_address"+ cAdv +"'  id='adv_address"+ cAdv +"' /></td><td><input type='text' name='adv_work"+ cAdv +"'  id='adv_work"+ cAdv +"' /></td><td><textarea name='adv_recommand"+ cAdv +"'  id='adv_recommand"+ cAdv +"' class='multyline' ></textarea></td></tr>");
				$("#count_adv").val(cAdv); 				
				break;
			case 'inst':
				cInt++;
				$("#tbl_inst").append('<tr><td><input class="institution_name"  type="text" id="inst_name' + cInt + '" name="inst_name' + cInt + '" /></td><td><input type="text" id="inst_from' + cInt + '" name="inst_from' + cInt + '" /></td><td><input type="text" id="inst_to' + cInt + '" name="inst_to' + cInt + '" /></td><td><textarea id="inst_comment' + cInt + '" name="inst_comment' + cInt + '"></textarea></td></tr>');
				$("#count_inst").val(cInt) ;
				$('#inst_name' + cInt).autocomplete({
					source: institutions_list
				});
				break;
			case	'rel':
				cRel++;
				$("#tbl_rel").append('<tr><td><input type="text" id="rel_familyName' + cRel + '" name="rel_familyName' + cRel + '" /></td><td><input type="text" id="rel_type' + cRel + '" name="rel_type' + cRel + '" /></td><td><input type="text" id="rel_flow' + cRel + '" name="rel_flow' + cRel + '" /></td><td><input type="text" id="rel_work' + cRel + '" name="rel_work' + cRel + '" /></td><td><input type="text" id="rel_address' + cRel + '" name="rel_address' + cRel + '" /></td><td><input type="text" id="rel_phone' + cRel + '" name="rel_phone' + cRel + '" /></td><td><textarea id="rel_comment' + cRel + '" name="rel_comment' + cRel + '"> </textarea></td></tr>');
				$("#count_rel").val(cRel);
				break;
		}
	}
	$(function(){
		$('.institution_name').autocomplete({
			minLength: 2,
			source: institutions_list
		});
		});
	</script>
	{/literal}
	<form name="env" id="env" method="post" action="candidate.php">
				<input type="hidden" id="id3" name="id" value="{$main_id}"/>
				<input type="hidden" id="type3" name="type" value="Enviorment"/>
				<input type="hidden" id="act3" name="act" value="{$act3}"/>
				<input type="hidden" id="count_adv" name="count_adv" value="{if $count_adv}{$count_adv}{else}3{/if}"/>
				<input type="hidden" id="count_inst" name="count_inst" value="{if $count_inst}{$count_inst}{else}3{/if}"/>
				<input type="hidden" id="count_rel" name="count_rel" value="{if $count_rel}{$count_rel}{else}3{/if}"/>
				
				<h3>ממליצים<a href="javascript:void(0);" onclick="addTableRow('adv');return false;">הוסף ממליץ</a></h3>
				<div class="multyDataCont">
					
					<ul>
					<li style='margin-left:39px;'><span class="required">*</span>שם/משפחה</li>
					<li style='margin-left:50px;'><span class="required">*</span>סוג קירבה</li>
					<li style='margin-left:42px;'>טלפון</li>
					<li style='margin-left:71px;'>כתובת</li>
					<li style='margin-left:75px'>תחום עיסוק</li>
					<li style=''>המלצה</li>
					</ul>
				<div class="scrollData">
				<table class="tblData" id="tbl_adv">
					{section name=adv_section loop=$adv start=0 step=1}
					{assign var='k' value=$smarty.section.adv_section.index}
					{assign var='k' value=$k+1}
					<input type="hidden" name="adv_id{$k}" value="{$adv[adv_section].id}" id="adv_id{
					$k}" />
					<tr>
					<td><input type="text" name="adv_name{$k}" value="{$adv[adv_section].name}" id="adv_name{$k}" /></td>
					<td><input type="text" name="adv_relate{$k}" value="{$adv[adv_section].relate}" id="adv_relate{$k}" /></td>
					<td><input type="text" name="adv_phone{$k}" value="{$adv[adv_section].phone}" id="adv_phone{$k}" /></td>
					<td><input type="text" name="adv_address{$k}" value="{$adv[adv_section].address}" id="adv_address{$k}" /></td>
					<td><input type="text" name="adv_work{$k}" value="{$adv[adv_section].work}" id="adv_work{$k}" /></td>
					<td><textarea name="adv_recommand{$k}"  id="adv_recommand{$k}" class='multyline' >{$adv[adv_section].recommand}</textarea></td>
					</tr>
					{/section}
				</table>
				</div>
				</div>
				<h3>מוסדות לימודיים<a href="javascript:void(0);" onclick="addTableRow('inst');return false;">הוסף מוסד לימודים</a></h3>
				<div class="multyDataCont">
					<ul>
						<li style='margin-left:49px'><span class="required">*</span>שם המוסד</li>
						<li style='margin-left:40px'>שנת התחלה</li>
						<li style='margin-left:56px'>שנת סיום</li>
						<li style=''>הערות</li>
					</ul>
					<div class="scrollData">
						<table class="tblData" id="tbl_inst">
						{section name=i loop=$inst start=0 step=1}
						{assign var='j' value=$smarty.section.i.index}
						{assign var='j' value= $j+1}
						<input type="hidden" name="inst_id{$j}" value="{$inst[i].id}" id="inst_id{
					$j}" />
						<tr>
						<td><input type="text" id="inst_name{$j}" name="inst_name{$j}" value="{$inst[i].name}" class="institution_name" /></td>
						<td><input type="text" id="inst_from{$j}" name="inst_from{$j}" value="{$inst[i].from}"/></td>
						<td><input type="text" id="inst_to{$j}" name="inst_to{$j}" value="{$inst[i].to}"/></td>
						<td><textarea id="inst_comment{$j}" name="inst_comment{$j}">{$inst[i].comment}</textarea></td>
						</tr>
						{/section}
						</table>
					</div>	
				</div>	
				<h3>מחותנים<a href="javascript:void(0);" onclick="addTableRow('rel');return false;">הוסף מחותנים</a></h3>
				<div class="multyDataCont">
				<ul>
					<li style='margin-left:43px;'><span class="required">*</span>שם משפחה</li>
					<li style='margin-left:48px;'><span class="required">*</span>סוג קירבה</li>
					<li style='margin-left:53px;'>שיוך מגזרי</li>
					<li style='margin-left:73px;'>עיסוק</li>
					<li style='margin-left:70px;'>כתובת</li>
					<li style='margin-left:77px;'>טלפון</li>
					<li style='margin-left:'>הערות</li>
				</ul>
					<div class="scrollData">
						<table class="tblData" id="tbl_rel">
						{section name=rel_section loop=$rel start=0 step=1}
						{assign var='l' value=$smarty.section.rel_section.index}
						{assign var='l' value= $l+1}
						<input type="hidden" name="rel_id{$l}" value="{$rel[rel_section].id}" id="rel_id{
					$l}" />
						<tr>
						<td><input type="text" id="rel_familyName{$l}" name="rel_familyName{$l}" value="{$rel[rel_section].familyName}"/></td>
						<td><input type="text" id="rel_type{$l}" name="rel_type{$l}" value="{$rel[rel_section].type}"/></td>
						<td><input type="text" id="rel_flow{$l}" name="rel_flow{$l}" value="{$rel[rel_section].flow}"/></td>
						<td><input type="text" id="rel_work{$l}" name="rel_work{$l}" value="{$rel[rel_section].work}"/></td>
						<td><input type="text" id="rel_address{$l}" name="rel_address{$l}" value="{$rel[rel_section].address}"/></td>
						<td><input type="text" id="rel_phone{$l}" name="rel_phone{$l}" value="{$rel[rel_section].phone}"/></td>
						<td><textarea id="rel_comment{$l}" name="rel_comment{$l}"> {$rel[rel_section].comments}</textarea></td>
						</tr>
						{/section}
						</table>
					</div>
				</div>
				<div class="buttons">
					<button role="button" onClick="submit_form('env','exit');"><span>שמור וצא</span></button>
					<button role="button" onClick="submit_form('env','next');"><span>שמור והמשך</span></button>
				</div>
			</form>	