<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();

$name = $_POST['name'];
$enabled = '0';
$position = '1';
$align = 'left';
$link = $_POST['link'];

$query = "INSERT INTO module (m_name, m_enabled, m_position, m_alignment, m_link) VALUES ('$name', '$enabled', '$position', '$align', '$link')";
mysql_query($query) or die(mysql_error());

echo "Your news has been submited, redirecting you.";
?>

<script type="text/javascript">
<!--
window.location = "index.php?page=modules"
//-->
</script>