<?php
if(!defined('SCMS')) die("Hacking attempt!");

global $site, $reg;
$reg = new plugin;
$temp = new tmpl;
?>
<div class="story-top">
	<div class="reghead"></div>
</div>
<div class="story">
<?php
if($_SESSION['user'][4] == "true") {
	echo "You must logout to use this function.";
}else{
	?>

	<div align="center" style="width: 300px padding-top : 30px">
		<form name='registration' action='?page=register&amp;action=create'
			method='post'>
			<table>
				<tr>
					<td><?php echo usern; ?></td>
					<td><input type='text' name='ruser' maxlength='20' value='' /></td>
				</tr>
				<tr>
					<td><?php echo passw; ?></td>
					<td><input type='password' name='rpass' maxlength='20' value='' />
					</td>
				</tr>
				<tr>
					<td><?php echo email; ?></td>
					<td><input type='text' name='remail' value='' /></td>
				</tr>
				<tr>
					<td><img id="captcha" src="./includes/securimage/securimage_show.php"
						alt="CAPTCHA Image" width="130" /></td>
					<td><input type="text" name="captcha_code" /></td>
				</tr>
				<tr>
					<td colspan='2' align='right'><input type='submit'
						name='registration' value='<?php echo register; ?>' /> &nbsp; <input
						type='reset' name='reset' value='<?php echo reset; ?>' />
					</td>
				</tr>
			</table>
		</form>
	</div>

	<?php
	if(isset($_POST['registration'])){
		$ruser = $_POST['ruser'];
		$rpass = $_POST['rpass'];
		$remail = $_POST['remail'];
		$cap = $_POST['captcha_code'];

		$reg->register($ruser,$rpass,$remail,$cap);

		if(Empty($reg->send_error) || $reg->head == true){
			print '<meta http-equiv="refresh" content="5;url=index.php">';
			foreach($reg->send_error as $er){
				print $er.'<br />';
			}
		}else{
			foreach($reg->send_error as $er){
				print $er.'<br />';
			}
		}
	}
}

?>
</div>
<div class="story-bot"></div>
