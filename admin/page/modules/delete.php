<?php
if(!defined('SCMS')) die('Hacking attempt!');

if(empty($_GET['id'])) {
	echo "ERROR Wrong ID";
	?>
<script type="text/javascript">
<!--
window.location = "index.php?page=modules"
//-->
</script>
    <?php
	
} else {
$sql = new sql;
$sql->wconnect();
$query = "DELETE FROM module WHERE m_id = '".$_GET['id']."' LIMIT 1";
mysql_query($query) or die(mysql_error());

echo "Your module has been removed, redirecting you.";
?>

<script type="text/javascript">
<!--
window.location = "index.php?page=modules"
//-->
</script>
<?php 
}
?>