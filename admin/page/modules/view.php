<?php
if(!defined('SCMS')) die('Hacking attempt!');


?>
	<style type="text/css">
<!--
.userlist {
	font-size: 12px;
}
.userlist {
	font-family: Tahoma, Geneva, sans-serif;
}
.ipstat {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
.txt {
	color: #000;
}
-->
    </style>
<script type="text/javascript">
<!--
function confirmation(ID) {
	var answer = confirm("Delete entry "+ID+" ?")
	if (answer){
		alert("Entry Deleted")
		window.location = "?page=modules&action=delete&id="+ID;
	}
	else{
		alert("No action taken")
	}
}
//-->
</script>
<b>-Left Modules-</b>
<table border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td id="navprimary" width="24" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">&nbsp;ID&nbsp;</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Position</td>
	<td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Name</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Enabled</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Allignment</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Options</td>
   </tr>
<?php
$sql = new sql;
$sql->wconnect();
$query = "SELECT * FROM module ORDER BY m_position ASC";
$result = mysql_query($query);
if (!$result) {
    $message  = mysql_error();
	error_reporting('E_NONE');
    echo $message;
}
while ($row = mysql_fetch_assoc($result)) {
	if($row['m_enabled'] == '1') {
		$enabled = 'yes';
	}else{
		$enabled = 'no';
	}
	if($row['m_alignment'] == 'left') {
?>
  <tr class="txt">
    <td align="center" class="userlist"><span class="userlist"><font  class="txt"><?php echo $row['m_id']; ?></span></td>
    <td align="center" class="userlist"><?php echo $row['m_position']; ?>&nbsp;&nbsp;<a href="?page=modules&action=position&f=increase&id=<?php echo $row['m_id']; ?>">
	  <img src="includes/images/arrow_up.gif" width="12" height="8" border="0"></a>&nbsp;<a href="?page=modules&action=position&f=decrease&id=<?php echo $row['m_id']; ?>">
	  <img src="includes/images/arrow_down.gif" width="12" height="8" border="0"></a></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['m_name']; ?></span></td>
	<td align="center" class="userlist"><span class="userlist"><?php echo $enabled; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['m_alignment']; ?></span></td>
    <td align="center" class="txt"><a href="?page=modules&action=edit&id=<?php echo $row['m_id']; ?>">
	  <img src="includes/images/edit-button.gif" width="16" height="18" border="0"></a>&nbsp;&nbsp;<a href="javascript:confirmation(<?php print $row['m_id']; ?>)"><img src="includes/images/aff_cross.gif" width="12" height="12" border="0"></a>
	</td>
   </tr>
<?php
	}
}
?>
</table>
<br>
<br>
<b>-Right Modules-</b>
<table border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td id="navprimary" width="24" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">&nbsp;ID&nbsp;</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Position</td>
	<td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Name</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Enabled</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Allignment</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Options</td>
   </tr>
<?php
$result1 = mysql_query($query);
if (!$result1) {
    $message  = mysql_error();
	error_reporting('E_NONE');
    echo $message;
}
while ($row1 = mysql_fetch_assoc($result1)) {
	if($row1['m_enabled'] == '1') {
		$enabled1 = 'yes';
	}else{
		$enabled1 = 'no';
	}
	if($row1['m_alignment'] == 'right') {
?>
  <tr class="txt">
    <td align="center" class="userlist"><span class="userlist"><font  class="txt"><?php echo $row1['m_id']; ?></span></td>
    <td align="center" class="userlist"><?php echo $row1['m_position']; ?>&nbsp;&nbsp;<a href="?page=modules&action=position&f=increase&id=<?php echo $row1['m_id']; ?>">
	  <img src="includes/images/arrow_up.gif" width="12" height="8" border="0"></a>&nbsp;<a href="?page=modules&action=position&f=decrease&id=<?php echo $row1['m_id']; ?>">
	  <img src="includes/images/arrow_down.gif" width="12" height="8" border="0"></a></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row1['m_name']; ?></span></td>
	<td align="center" class="userlist"><span class="userlist"><?php echo $enabled1; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row1['m_alignment']; ?></span></td>
    <td align="center" class="txt"><a href="?page=modules&action=edit&id=<?php echo $row1['m_id']; ?>">
	  <img src="includes/images/edit-button.gif" width="16" height="18" border="0"></a>&nbsp;&nbsp;<a href="javascript:confirmation(<?php print $row1['m_id']; ?>)"><img src="includes/images/aff_cross.gif" width="12" height="12" border="0"></a>
	</td>
   </tr>
<?php
	}
}
?>
</table>
<br>
<br>
<?php
$tmpl = new tmpl;
echo $tmpl->opencontent("page/modules/add.php");
?>