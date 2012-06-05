<div class="left-sidebar">
		<div class='search-form'>	
			<form name='long_search' id='long-search' action='{$SERVER_ROOT}result.php' method='post'>
				<input type='hidden' name='search_type' value='global-search' />
				<input type='text' name='search' id='search' class='search-input' />
				<input type='submit' id='submit' name='submit' value='חיפוש כללי' class='search-input-submit' />
			</form>
		</div>	
		<div style='clear:both;display:none;'>	
			
			<a href="#" class="img"></a>
			<a href="#" class="img"></a>
			<a href="#" class="img"></a>
			<a href="#" class="img" style="margin-right: 0px;"></a>
		</div>	
			<div id="left-column">
			
				<h2>פגישות קרובות</h2>
				{last_meetings data=$last_meetings}
			
			</div>
			
			<div id="right-column">
			
				<h2>מועמדים חדשים</h2>
				<ul>
				
				{section name=i loop=$id}
				
					<li><strong>{$firstName[i]}&nbsp; {$lastName[i]}&nbsp;{$age[i]}&nbsp;-&nbsp;&nbsp;{$phone[i]}</strong>
					<a href="candidate.php?id={$id[i]}">עוד...</a></li>
				
			{sectionelse}
			<div>
				אין נתונים כרגע במערכת
			</div>
			{/section}
				</ul>
			
			</div>
			
			
		
		</div>
		{literal}
<style>
	#right-column ul li a{text-decoration:none;}
	#right-column ul li a:hover{color:crimson;}
</style>
<script>
	$(document).ready(function (){
		global_search_init();
		});
</script>
{/literal}