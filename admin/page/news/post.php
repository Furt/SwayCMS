<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();

$author = $_POST['author'];
$title = $_POST['title'];
$news = nl2br($_POST['news']);
$time = date("m/d/Y");

$query = "INSERT INTO news (postdate, author, title, news) VALUES ('$time', '$author', '$title', '$news')";
mysql_query($query) or die(mysql_error());

echo "Your news has been submited, redirecting you.";
?>

<script type="text/javascript">
<!--
window.location = "index.php?page=news&action=view"
//-->
</script>