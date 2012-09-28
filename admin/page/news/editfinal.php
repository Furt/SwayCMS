<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();
$author = $_POST['author'];
$title = $_POST['title'];
$news = nl2br($_POST['news']);
$query = "UPDATE news SET title='".$_POST['title']."', news='".nl2br($_POST['news'])."'  WHERE id = ".$_GET['id']." LIMIT 1 ;";
mysql_query($query) or die(mysql_error());
echo "Your news has been edited, redirecting you.";
?>
<script type="text/javascript">
<!--
window.location = "index.php?page=news&action=view"
//-->
</script>