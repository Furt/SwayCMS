<?php

	global $plugin;
	$plugin = new plugin;
	
if(isset($_SESSION['admin'][4]) == "false") {
	if(isset($_GET['a']) != "login") {
	echo '
			<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
			<form action="?page=admin&a=login" method="post" name="submit">
			<tr>
				<td>Username: </td><td><input id="username" name="username" type="text" value="" size="10" maxlength="30"></td>
			</tr>
			<tr>
				<td>Password: </td><td><input id="password" name="password" type="password" value="" size="10" maxlength="30"></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input name="submit" type="submit" value="Login" /></td>
			</tr></form>
			</table>';	
	}
}

if(isset($_GET['a']) == 'logout') {
	session_unset();
	session_destroy();
	?>
    <script type="text/javascript">
	<!--
	window.location = "../index.php"
	//-->
	</script>
	<?php
}

if(isset($_GET['a']) == 'login') {
	$plugin->login($_POST['username'],$_POST['password']);
	
	if(Empty($plugin->send_error) || $plugin->head == true){
		print '<meta http-equiv="refresh" content="3;url=index.php">';
		foreach($plugin->send_error as $er){
			print $er.'<br />';
		}
	}else{
		print '<meta http-equiv="refresh" content="3;url=index.php?page=admin">';
		foreach($plugin->send_error as $er){
			print $er.'<br />';
		}
	}
}
?>
