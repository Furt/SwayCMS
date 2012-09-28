<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();

$name = $_POST['name'];
$link = $_POST['link'];

$query = "INSERT INTO menu (name, page) VALUES ('$name', '$link')";
mysql_query($query) or die(mysql_error());

echo "Your navigation link has been added, redirecting you.";
?>

<script type="text/javascript">
<!--
window.location = "index.php?page=navigation"
//-->
</script>