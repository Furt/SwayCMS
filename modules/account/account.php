<?php
if(!defined('SCMS')) die("Hacking attempt!");
?>
<form name="login" action="?page=account&amp;function=login"
	method="post">
	<table width="90%" border="0" align="center" cellpadding="0"
		cellspacing="5">
		<?php

		if($_SESSION['user'][4] == "true"){
			echo '<td align="center">Welcome '. ucfirst($_SESSION['user'][1]) .'</td></tr><tr>'.
		 '<td align="center"><a href="?page=account">Profile</a> | <a href="?page=account&function=logout">Logout</a>'.
		 '</td></tr>';
			if($_SESSION['admin'][4] == 'true') {
				echo '<tr><td align="center"><a href="./admin">Admin Panel</a></td></tr>';
			}
			echo '<tr><td align="center">Last Login:</td></tr>'.
		 '<tr><td align="center">'. $_SESSION['user'][5] .'</td></tr>';
		}else {
			?>

		<tr>
			<td align="center">Username</td>
		</tr>
		<tr>
			<td align="center"><input id="username" name="username" type="text"
				value="" size="10" maxlength="30" /></td>
		</tr>
		<tr>
			<td align="center">Password</td>
		</tr>
		<tr>
			<td align="center"><input id="password" name="password"
				type="password" value="" size="10" maxlength="30" /></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input name="login" type="submit"
				value="Login" /></td>
		</tr>

		<tr>
			<td align="center" colspan="2"><a
				href="?page=help&amp;function=getpass">Forgot pass</a></td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
