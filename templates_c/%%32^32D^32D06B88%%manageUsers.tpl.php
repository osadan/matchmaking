<?php /* Smarty version 2.6.18, created on 2012-01-05 11:28:08
         compiled from manageUsers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'manageUsers.tpl', 54, false),)), $this); ?>
<?php echo '
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
var last = '; ?>
<?php echo $this->_tpl_vars['last']; ?>
<?php echo ';
var cur = '; ?>
<?php echo $this->_tpl_vars['cur']; ?>
<?php echo ';
function find(){
	location.href = server_root + "manageUsers.php?find=" + $("#find").val();
}
</script>
'; ?>

<div class="tab">
	<input type="text" id="find" name="find" value="<?php echo $this->_tpl_vars['find']; ?>
" class="find" />
	<input type="button" onClick="find()" value="חיפוש" />
	
		
	
	<table class="list" id="list">
	<caption style="text-align:right;font-size:14px;font-weight:bold;" >טבלת משתמשים </caption>
		<thead>
		<th>זיהוי</th><th>שם פרטי</th><th>שם משפחה</th><th>הרשאה</th><th>כינוי</th><th>טלפון</th><th>פלאפון</th>
		</thead>
		<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['start'] = (int)0;
$this->_sections['u']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
if ($this->_sections['u']['start'] < 0)
    $this->_sections['u']['start'] = max($this->_sections['u']['step'] > 0 ? 0 : -1, $this->_sections['u']['loop'] + $this->_sections['u']['start']);
else
    $this->_sections['u']['start'] = min($this->_sections['u']['start'], $this->_sections['u']['step'] > 0 ? $this->_sections['u']['loop'] : $this->_sections['u']['loop']-1);
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = min(ceil(($this->_sections['u']['step'] > 0 ? $this->_sections['u']['loop'] - $this->_sections['u']['start'] : $this->_sections['u']['start']+1)/abs($this->_sections['u']['step'])), $this->_sections['u']['max']);
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
			<tr>
				<td style="width:10px;"><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['id']; ?>
</td>
				<td><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['firstName']; ?>
</td>
				<td><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['lastName']; ?>
</td>
				<td><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['premmisions']; ?>
</td>
				<td><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['nickName']; ?>
</td>
				<td><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['phone']; ?>
</td>
				<td><?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['cellphone']; ?>
</td>
				<td><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
users.php?action=edit&id=<?php echo $this->_tpl_vars['list'][$this->_sections['u']['index']]['id']; ?>
">ערוך</a>
			</tr>
		<?php endfor; endif; ?>
	</table>
	<br />
	<a class="addNew" href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
users.php">הוספת משתמש חדש</a>
	<div class="paging">		
	<ul>
		<li id="first"><a href="manageUsers.php?s=<?php echo 0; ?>
&find=<?php echo $this->_tpl_vars['find']; ?>
">ראשון</a><span class="sl">|</span></li>
		<li id="prev"><a href="manageUsers.php?s=<?php if ($this->_tpl_vars['cur'] > 0): ?><?php echo smarty_function_math(array('equation' => 'c - 1','c' => $this->_tpl_vars['cur']), $this);?>
<?php else: ?>0<?php endif; ?>&find=<?php echo $this->_tpl_vars['find']; ?>
">הקודם</a><span class="sl">|</span></li>
		<li id="next"><a href="manageUsers.php?s=<?php echo smarty_function_math(array('equation' => 'c + 1','c' => $this->_tpl_vars['cur']), $this);?>
&find=<?php echo $this->_tpl_vars['find']; ?>
">הבא</a><span class="sl">|</span></li>
		<li id="last"><a href="manageUsers.php?s=<?php echo $this->_tpl_vars['last']; ?>
&find=<?php echo $this->_tpl_vars['find']; ?>
">אחרון</a></li>
	</ul>
	</div>
	
</div>
<?php echo '
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
'; ?>