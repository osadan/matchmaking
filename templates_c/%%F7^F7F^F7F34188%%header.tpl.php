<?php /* Smarty version 2.6.18, created on 2011-10-05 23:20:27
         compiled from header.tpl */ ?>
		<h1><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
">שידוכי כיד המלך</a></h1>
		<h2>ועניין מציאת הזיווג במהרה, הוא עניין של , תפילה לפני בורא עולם שהוא המזווג זיווגים ,<br />
		וכך דורשים חז"ל את הכתוב בתהילים "על זאת יתפלל כל חסיד אליך לעת מצא" ,-מצא אישה מצא טוב<br /> 
		 <span style="font-size: 9pt;">רב אושר פריינד</span></h2>
		
		<menu>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
candidate.php" id="active">הוסף מועמד חדש</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
list.php">בחירת מועמדים</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
manageUsers.php">משתמשים</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
manageItems.php">ניהול הגדרות</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
reports.php">דוחו"ת</a></li>
			<?php if ($this->_tpl_vars['user']->userid): ?>
				<li class="logout"><a href="javascript:logout()">יציאת משתמש</a></li>
			<?php endif; ?>
		
		</menu>
		<div class="message"><?php echo $this->_tpl_vars['message']; ?>
</div>