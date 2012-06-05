{literal}
<script>
	$(function() {
		$("#sortable1, #sortable2").sortable({
			connectWith: '.connectedSortable'
		}).disableSelection();
		$(".candidate").find(".candidate-header").addClass("ui-widget-header ui-corner-all").prepend('<span class="ui-icon ui-icon-plusthick"></span>').end().find(".portlet-content");
		$(".candidate-header").click(function(){
			$(this).find('.ui-icon').toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
			$(this).parents(".candidate:first").find(".candidate-content").slideToggle();
			
		}).find('.ui-icon').css("float","left");
		$(".candidate-content").css('display','none');
		global_search_init();
	});
</script>
{/literal}
<div class='search-form'>	
			<form name='long_search' id='long-search' action='{$SERVER_ROOT}result.php' method='post'>
				<input type='hidden' name='search_type' value='global-search' />
				<input type='text' name='search' id='search' class='search-input' value='{$search_value}' />
				<input type='submit' id='submit' name='submit' value='חיפוש כללי' class='search-input-submit' />
			</form>
</div>
<ul id="sortable1" class="connectedSortable" >
	{section name=c loop=$id}
	<li class="ui-state-default">
		<div class="candidate">
			<div class="candidate-header">
				<span class="headerText"><a href='{$SERVER_ROOT}candidate.php?id={$id[c]}' >{$firstName[c]}  {$lastName[c]}</a></span>
			</div>
			<div class="candidate-content">
				<div>
					{if $street[c] != ""}
						<span class="label">רחוב :</span><span class="desc">{$street[c]}</span>
					{/if}
					{if $neighborhood[c] != ""}
						<span class="label">שכונה :</span><span class="desc">{$neighborhood[c]}</span>
					{/if}
				</div>
				{if $city[c] != ""}
				<div>
					<span class="label">עיר :</span><span class="desc">{$city[c]}</span>
				</div>
				{/if}
				<div>
					{if $phone[c] != ""}
						<span class="label">טלפון :</span><span class="desc">{$phone[c]}</span>
					{/if}
					{if $cellphone[c] != ""}
						<span class="label">פלאפון :</span><span class="desc">{$cellphone[c]}</span>
					{/if}
				</div>
				<div style="height:15px">
					<a href="{$SERVER_ROOT}candidate.php?id={$id[c]}" target='_blank'>....עוד</a>
				</div>
			</div>
		</div>
	</li>
	{/section}
</ul>
<ul id="sortable2" class="connectedSortable droptrue">

</ul>
<div>

</div>
