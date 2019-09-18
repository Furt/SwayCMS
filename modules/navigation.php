<?php
if(!defined('SCMS')) die("Hacking attempt!");

$sql = new sql();
$m = $sql->wconnect();
$query = "SELECT id, name, page FROM menu";
$result = mysqli_query($m, $query);

if (!$result) {
	$message  = mysql_error();
	error_reporting('E_NONE');
	echo $message;
}
$lnks = '<ul>';

while ($row = mysqli_fetch_assoc($result)) {
	$lnks .= "<li><a href='index.php".$row['page']."'>".$row['name']."</a></li>";
}
$lnks .= "</ul>";
echo $lnks;
?>