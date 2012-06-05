{literal}
<script type="text/javascript">
$(document).ready(function(){
	var open_tab = 0;
    $("#tabs").tabs({cache:true ,
   		select: function (event,ui){
			if (ui.index != 0 && $("#frmMainDetails input[name='id']").val() == false){
				if( $("#frmMainDetails").valid() ){
					$("#frmMainDetails").submit();
				}
				//return submit_form('frmMainDetails','next');
				return false;
			}
		}
    });
	 $("button").button();
	{/literal}
		{$open_tab}
	{literal}
	 
	 +function(){
		$("#tabs").tabs('select',open_tab);
		var selected = $('#tabs').tabs('option', 'selected');
		setFocus(selected);
	}();
	$('#tabs').bind('tabsshow', function(event, ui) {
		setFocus(ui.index);
	 });
	compare_age_input_init('year','age',{/literal}{$this_jewish_year}{literal});
	$('.user-operation-ribbon .ui-icon-person').bind('click mouseover',function(){
		
		$('.ribbon-content').slideToggle();
		
	});

});
{/literal}
	{institution_list}	
{literal}	
 
  </script>
{/literal}
<!-- TODO  Add the time of the last update on update mode-->
<div id="tabs">
	{if $firstName }
		<div class='candidate-page-title'>
			<h2> {$firstName} {$lastName}</h2>
			<div class='user-operation-ribbon'>
				<span class='ui-icon ui-icon-person'></span>
				<div class='ribbon-canvas'>
					<div class='ribbon-content'>

						<div><a class='link remove-user'>הסר משתמש</a></div>

					</div>
				</div>
			</div>
		</div>
	{/if}
    <ul class='person-nev'>
        <li><a href="#fragment-1"><span>פרטים אישיים</span></a></li>
        <li><a href="#fragment-2"><span>מראה חיצוני</span></a></li>
        <li><a href="#fragment-3"><span>נתוני סביבה</span></a></li>
		<li><a href="#fragment-4"><span>חיפוש</span></a></li>
		<li><a id='offers-meetings' href="#fragment-5"><span>הצעות/פגישות</span></a></li>
    </ul>
	
    <div id="fragment-1" class='tab'>
		{include file="person_form_details.tpl"}
	</div>
    <div id="fragment-2" class='tab'>
		{include file='person_form_extrnal.tpl"}
    </div>
	
    <div id="fragment-3" class='tab'>
			{include file='person_form_env.tpl"}
	</div>
	<div id="fragment-4" class='tab'>
			{include file='person_form_search.tpl"}
	</div>
	<div id='fragment-5' class='tab'>
			{include file='person_form_mettings.tpl"}
	</div>
</div>
