		<h1><a href="{$SERVER_ROOT}">������ ��� ����</a></h1>
		<h2>������ ����� ������ �����, ��� ����� �� , ����� ���� ���� ���� ���� ������ ������� ,<br />
		��� ������ ��"� �� ����� ������� "�� ��� ����� �� ���� ���� ��� ���" ,-��� ���� ��� ���<br /> 
		 <span style="font-size: 9pt;">�� ���� ������</span></h2>
		
		<menu>
			<li><a href="{$SERVER_ROOT}candidate.php" id="active">���� ����� ���</a></li>
			<li><a href="{$SERVER_ROOT}list.php">����� �������</a></li>
			<li><a href="{$SERVER_ROOT}manageUsers.php">�������</a></li>
			<li><a href="{$SERVER_ROOT}manageItems.php">����� ������</a></li>
			<li><a href="{$SERVER_ROOT}reports.php">����"�</a></li>
			{if $user->userid}
				<li class="logout"><a href="javascript:logout()">����� �����</a></li>
			{/if}
		
		</menu>
		<div class="message">{$message}</div>