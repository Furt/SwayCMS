<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();
$name = $_POST['name'];
$link = $_POST['link'];
$query = "UPDATE menu SET name='$name', page='$link'  WHERE id='".$_GET['id']."'";
mysql_query($query) or die(mysql_error());
echo "Link $name has been updated, redirecting you.";
?>
<script type="text/javascript">
<!--
window.location = "index.php?page=navigation"
//-->
</script>