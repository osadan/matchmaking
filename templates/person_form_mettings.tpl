{literal}
	<script>
	$(function() {
		$(".meetings-tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
		$(".meetings-tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');

		$(".candidate-header").click(function(){
			$(this).find('.ui-icon').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
			$(this).next(".candidate-meetings-panel").slideToggle();
			
		}).find('.ui-icon').css("float","left");
		

		$(".add-new-meeting").click(function (){
			$div_form = $(this).parent('div').next('div.add-new-meeting-form');  
			 $div_form.slideToggle(1000);
			 $(this).find('.ui-icon').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
			 if ($(this).find('.ui-icon').hasClass('ui-icon-plusthick')){
				 $(this).find('.add-new-meeting-text').text('הוסף פגישה');
				 $div_form.find('form').find('input[name !="offer_id"],select,textarea').val('');
				 }
			 else{
				 $(this).find('.add-new-meeting-text').text('סגור');	
				 }
			});
	});
	</script>
{/literal}
		
		
		<div class='person_form_meetings'>
		{foreach name=meetings from=$on_meetings item=m}
			{if $smarty.foreach.meetings.first == true}	<h3>פגישות</h3>{/if}
			<div>
					{candidate_expended 
					candidate=$m 
					person_id=$main_id 
					person_gender=$search_gender
					type = 'meeting'
				}
			</div>
		{/foreach}
		
		{foreach name=offers from=$on_offers item=o}
			{if $smarty.foreach.offers.first == true}<h3>הצעות</h3>{/if}
			<div>
				{candidate_expended 
					candidate=$o 
					person_id=$main_id 
					person_gender=$search_gender
					type = 'offers'
				}
			</div>
		{/foreach}
		
		{foreach name=refused from=$on_refused item=r}
			{if $smarty.foreach.refused.first == true}<h3>הצעות שנדחו</h3>{/if}
			<div>{$r.firstName}</div>
		{/foreach}
		
		</div>
		<div id='meeting-comments-dialog'>
			<textarea rows='5' cols='34' name='metting-comments-dialog' id='textarea-metting-comments-dialog'>
			</textarea>
		</div>
{literal}
<script>
var offer_stauts_title;
var process_type;
var offer_status_text;
	$(function(){
		
		
		$('#meeting-comments-dialog').dialog({
			autoOpen:false,
			modal:true,
			position:'center',
			dialogClass: 'ui-widget-wrapper',
			buttons:{ 'שמור' : function(){
						$(this).dialog('close');
					}					
				}
			});
	});
</script>
{/literal}
