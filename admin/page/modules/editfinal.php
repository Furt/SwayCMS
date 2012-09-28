<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();
$name = $_POST['name'];
$enabled = $_POST['enabled'];
$align = $_POST['alignment'];
$link = $_POST['link'];
$query = "UPDATE module SET m_name='$name', m_enabled='$enabled', m_alignment='$align', m_link='$link'  WHERE m_id='".$_GET['id']."'";
mysql_query($query) or die(mysql_error());
echo "Module $name has been updated, redirecting you.";
?>
<script type="text/javascript">
<!--
window.location = "index.php?page=modules"
//-->
</script>