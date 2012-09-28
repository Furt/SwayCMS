<?php
if(!defined('SCMS')) die('Hacking attempt!');
?>
<center>
	Add Module<br>
	<form method="post" action="?page=modules&action=post">
		<table width="500px" align="center" border="0" cellspacing="0"
			cellpadding="3">

			<tr>
				<td width="30%" align="right">Name</td>
				<td width="1%">&nbsp;:&nbsp;</td>
				<td width="69%" class="Formtext"><input name="name" type="text"
					value="" width="150" height="15" /></td>
			</tr>
			<tr>
				<td align="right">Link</td>
				<td width="1%">&nbsp;:&nbsp;</td>
				<td class="Formtext"><input name="link" type="text"
					class="inputitems" value="" width="150" height="15" />
			
			</tr>
			<tr>
				<td class="formtext" align="center" colspan="3"><input name="submit"
					type="submit" value="Submit" /></td>
			</tr>

		</table>
	</form>
	<br />
</center>
