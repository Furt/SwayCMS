<?php
if(!defined('SCMS')) die('Hacking attempt!');

global $site;
if(!isset($_GET['action'])) {
	$_GET['action'] = '';
}
if($_GET['action'] == 'post') {
	$confedit = new ConfigEditor();
	$confedit->LoadFromFile('../includes/config.inc.php');
	$confedit->SetVar('site', array('name' => $_POST['name'], 'template' => $_POST['theme'], 'news' => $_POST['news'], 'news_post' => $_POST['news_post'], 'plugin' => $_POST['plugin'], 'language' => $_POST['language'], 'forum' => $_POST['forum'], 'mysql' => $_POST['mysql']), 'Site Options');
	$config_php = $confedit->Save('../includes/config.inc.php');
?>
<script language="javascript">confirm("Site edit was successful!")</script>
<?php
print '<meta http-equiv="refresh" content="0;url=index.php?page=site">';
}
?>
<table><form name="submit" method="post" enctype="application/x-www-form-urlencoded" action="?page=site&action=post">
<tr>
<td align="right">Site name:</td><td><input type="text" name="name" value="<?php echo $site['name']; ?>"></td>
</tr>
<tr>
<td align="right">Theme:</td><td><input type="text" name="theme" value="<?php echo $site['template']; ?>"></td>
</tr>
<tr>
<td align="right">News Plugin:</td><td><input type="text" name="news" value="<?php echo $site['news']; ?>"></td>
</tr>
<tr>
<td align="right">News Count:</td><td><input type="text" name="news_post" value="<?php echo $site['news_post']; ?>"></td>
</tr>
<tr>
<td align="right">Account Plugin:</td><td><input type="text" name="plugin" value="<?php echo $site['plugin']; ?>"></td>
</tr>
<tr>
<td align="right">Language:</td><td><input type="text" name="language" value="<?php echo $site['language']; ?>"></td>
</tr>
<tr>
<td align="right">Forum Link:</td><td><input type="text" name="forum" value="<?php echo $site['forum']; ?>"></td>
</tr>
<tr>
<td align="right">Data Storage:</td><td><input type="text" name="mysql" value="<?php echo $site['mysql']; ?>"></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Change site settings" class="button" width="95%" style="width:95%"/></td>
</tr>
</form></table>
