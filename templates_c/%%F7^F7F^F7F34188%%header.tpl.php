<?php /* Smarty version 2.6.18, created on 2011-10-05 23:20:27
         compiled from header.tpl */ ?>
		<h1><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
">������ ��� ����</a></h1>
		<h2>������ ����� ������ �����, ��� ����� �� , ����� ���� ���� ���� ���� ������ ������� ,<br />
		��� ������ ��"� �� ����� ������� "�� ��� ����� �� ���� ���� ��� ���" ,-��� ���� ��� ���<br /> 
		 <span style="font-size: 9pt;">�� ���� ������</span></h2>
		
		<menu>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
candidate.php" id="active">���� ����� ���</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
list.php">����� �������</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
manageUsers.php">�������</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
manageItems.php">����� ������</a></li>
			<li><a href="<?php echo $this->_tpl_vars['SERVER_ROOT']; ?>
reports.php">����"�</a></li>
			<?php if ($this->_tpl_vars['user']->userid): ?>
				<li class="logout"><a href="javascript:logout()">����� �����</a></li>
			<?php endif; ?>
		
		</menu>
		<div class="message"><?php echo $this->_tpl_vars['message']; ?>
</div>