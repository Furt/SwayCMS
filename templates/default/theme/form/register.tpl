<div align="center" style="width: 300px">
	<br /> <br /> <br /> <br />
	<form name='registration' action='?pageid=register&action=create'
		method='POST' enctype='application/x-www-form-urlencoded'
		onsubmit='return verifyMe();'>
		<table cellspacing='0'>
			<tr>
				<td><?php echo usern; ?></td>
				<td><input type='text' name='user' id='user' maxlength='20' value=''>
				</td>
			</tr>
			<tr>
				<td><?php echo passw; ?></td>
				<td><input type='password' name='pass' id='pass' maxlength='20'
					value=''></td>
			</tr>
			<tr>
				<td><?php echo email; ?></td>
				<td><input type='text' name='email' id='email' value=''></td>
			</tr>
			<tr>
			<?php
			if (plugin != "default") {

				$plugin = new plugin;
				echo $plugin->expForm();

			}
			?>
				<td><img id="captcha" src="./includes/secure/securimage_show.php"
					alt="CAPTCHA Image" width="130" /></td>
				<td><input type="text" name="captcha_code" id="text3" /></td>
			</tr>
			<tr>
				<td colspan='2' align='right'><input type='submit'
					name='registration' value='<?php echo register; ?>'> &nbsp; <input
					type='reset' name='reset' value='<?php echo reset; ?>'> <br />
				</td>
			</tr>
		</table>
	</form>
</div>