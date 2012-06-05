<div class='container search-container'>
	<div class="right-sidebar search-bar">
		<form id='search-form' name='search-form' action='candidate.php' method='post'>
		<input type='hidden' name='search_gender' id='search_gender' value='{$search_gender}' />
		<input type='hidden' name='type' id='type' value='search' />
		<input type="hidden" value="{$main_id}" name="id" id="id"/>
		<div class='search-group'>
			<div class='search-group-title'>
				<h4>פרטים כללים</h4>
				<div class='search-group-collapse-icon on'>
				&#9650;
				</div>
			</div>
			<div class='search-group-content'>
				<div>
					<label for='general'>חיפוש כללי:</label>
					<input type='text' name='general' id='general' />
				</div>
				<div class="stable">
					<span  class='text'>גיל:</span>
					<span class="text">בין</span><input type="text" size="2" id="age_from" name="age_from" />
					<span class="text">ל</span><input type="text" size="2" id="age_to" name="age_to" />
				</div>
				<div>
					<label for='general'>מחותנים:</label>
					<input type='text' name='relatives' id='relatives' />
				</div>
				<div>
					<label for='general'>מוסדות לימוד:</label>
					<input type='text' name='institutions' id='institutions' />
				</div>
				<input type="button" name="" value="חפש" />
			</div>
			
		</div>
		
		{foreach from=$search_data name=outer key=item_name item=def_arr}
			{if $def_arr.item_view_name != "" }
				<div class='search-group'>
					<div class='search-group-title'>
						<h4>{$def_arr.item_view_name}</h4>
						<div class='search-group-collapse-icon off'>
						&#9660;
						</div>
					</div>
					<div class='search-group-content' style='display:none'>
				{foreach from=$def_arr name=inner key=key item=value}
					{if $key != 'item_view_name'}
						<div>
							<input type='checkbox' value='{$key}' name='def_{$key}' id='{$item_name}{$key}' />
							<label class='inline'>{$value}</label>
						</div>
					{/if}
				{/foreach}
						<input type="button" name="" value="חפש" />
					</div>
				</div>
			{/if}
		{/foreach}
		</form>
	</div>
	<div  class="left-sidebar">
		<div class='candidate-list-wrapper'>
			<ul>
				{foreach from=$candidates name=candidates  item=candidate_item}
					{candidate item=$candidate_item person_id=$main_id person_gender=$search_gender}
				{/foreach}
			</ul>
		</div>
	</div>
</div>
{literal}
<script>
	$(function(){
			$(".search-group-collapse-icon").click(function (){
					search.toggle_group(this);
				});
			$(".search-group input[type=button]").click(function (){
					search.search_submit();
				});
			$(".candidate-header").click(function(){
				$(this).find('.ui-icon').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
				$(this).parents(".candidate:first").find(".candidate-content").slideToggle();
				
			}).find(".ui-icon").css("float","left");
			$(".candidate-content.candidate-search").css('display','none');
		});
</script>
{/literal}