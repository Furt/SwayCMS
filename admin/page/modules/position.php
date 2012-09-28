<?php
if(!defined('SCMS')) die('Hacking attempt!');

$pos = '';
$sql = new sql();
$sql->wconnect();
$query = "SELECT m_position FROM module WHERE m_id='".$_GET['id']."' LIMIT 1";
$result = mysql_query($query);

if (!$result) {
    $message  = mysql_error();
	error_reporting('E_NONE');
    echo $message;
}
if(!isset($_GET['f'])) {
	$_GET['f'] = 'error';
}
if($_GET['f'] == 'increase') {
	while($row = mysql_fetch_assoc($result)) {
		$pos = $row['m_position'];
		$pos++;
		$pquery = "UPDATE module SET m_position='$pos' WHERE m_id='".$_GET['id']."'";
		$presult = mysql_query($pquery);
		if (!$presult) {
			$message  = mysql_error();
			error_reporting('E_NONE');
			echo $message;
		}
	}
}

if($_GET['f'] == 'decrease') {
	while($row = mysql_fetch_assoc($result)) {
		$pos = $row['m_position'];
		$pos--;
		$pquery = "UPDATE module SET m_position='$pos' WHERE m_id='".$_GET['id']."'";
		$presult = mysql_query($pquery);
		if (!$presult) {
			$message  = mysql_error();
			error_reporting('E_NONE');
			echo $message;
		}
	}
}
?>
<script type="text/javascript">
<!--
window.location = "index.php?page=modules"
//-->
</script>