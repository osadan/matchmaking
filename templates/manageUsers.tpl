{literal}
<style>
	table.list{direction:rtl;border-collapse:collapse;margin:20px auto;text-align:right;}
	table.list td {border:1px solid black;padding:0px;margin:0px;padding-right:4px;padding-left:4px;}
	table.list th {}
	table.list th {width:100px;}
	div.tab{direction:rtl;padding:15px;text-align:center;}
	div.paging{text-align:center;margin:0px auto;width:185px;margin-top:10px;clear:block;}
	div.paging ul{list-style-type:none;height:21px;text-align:center;border:1px solid crimson;}
	div.paging ul li{display:inline;float:right;margin:0px 5px;}
	div.paging ul li a{text-decoration:None;}
	div.paging ul li a:hover{color:crimson;}
	input[type="text"].find {width:330px;margin:0px auto;}
	a.addNew {float:left;margin:-37px 45px 0 0;float:right;}
	.sl {margin-right:9px;}
</style>
<script>
var last = {/literal}{$last}{literal};
var cur = {/literal}{$cur}{literal};
function find(){
	location.href = server_root + "manageUsers.php?find=" + $("#find").val();
}
</script>
{/literal}
<div class="tab">
	<input type="text" id="find" name="find" value="{$find}" class="find" />
	<input type="button" onClick="find()" value="חיפוש" />
	
		
	
	<table class="list" id="list">
	<caption style="text-align:right;font-size:14px;font-weight:bold;" >טבלת משתמשים </caption>
		<thead>
		<th>זיהוי</th><th>שם פרטי</th><th>שם משפחה</th><th>הרשאה</th><th>כינוי</th><th>טלפון</th><th>פלאפון</th>
		</thead>
		{section name=u loop=$list start=0 step=1}
			<tr>
				<td style="width:10px;">{$list[u].id}</td>
				<td>{$list[u].firstName}</td>
				<td>{$list[u].lastName}</td>
				<td>{$list[u].premmisions}</td>
				<td>{$list[u].nickName}</td>
				<td>{$list[u].phone}</td>
				<td>{$list[u].cellphone}</td>
				<td><a href="{$SERVER_ROOT}users.php?action=edit&id={$list[u].id}">ערוך</a>
			</tr>
		{/section}
	</table>
	<br />
	<a class="addNew" href="{$SERVER_ROOT}users.php">הוספת משתמש חדש</a>
	<div class="paging">		
	<ul>
		<li id="first"><a href="manageUsers.php?s={0}&find={$find}">ראשון</a><span class="sl">|</span></li>
		<li id="prev"><a href="manageUsers.php?s={if $cur > 0}{math equation='c - 1' c=$cur}{else}0{/if}&find={$find}">הקודם</a><span class="sl">|</span></li>
		<li id="next"><a href="manageUsers.php?s={math equation='c + 1' c=$cur}&find={$find}">הבא</a><span class="sl">|</span></li>
		<li id="last"><a href="manageUsers.php?s={$last}&find={$find}">אחרון</a></li>
	</ul>
	</div>
	
</div>
{literal}
<script>
$(document).ready(function(){
function setPagingVisiblity(){
	if (cur < 1) {
		$("#first a").css("color","gray").attr("href","javascript:void(0)");
		$("#prev a").css("color","gray").attr("href","javascript:void(0)");
	}
	if( cur >= last){
			$("#next a").css("color","gray").attr("href","javascript:void(0)");
			$("#last a").css("color","gray").attr("href","javascript:void(0)");
	
	}
	};
	setPagingVisiblity();
});

</script>
{/literal}