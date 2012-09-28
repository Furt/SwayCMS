<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();
$query = "SELECT * FROM menu ORDER BY id ASC";
$result = mysql_query($query);
if (!$result) {
    $message  = mysql_error();
	error_reporting('E_NONE');
    echo $message;
}
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
		window.location = "?page=navigation&action=delete&id="+ID;
	}
	else{
		alert("No action taken")
	}
}
//-->
</script>

 <table border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td id="navprimary" width="24" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">&nbsp;ID&nbsp;</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Page</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Link</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Options</td>
   </tr>
 <?php
while ($row = mysql_fetch_assoc($result)) {
?>
  <tr class="txt">
    <td align="center" class="userlist"><span class="userlist"><font  class="txt"><?php echo $row['id']; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['name']; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['page']; ?></span></td>
    <td align="center" class="txt"><a href="?page=navigation&action=edit&id=<?php echo $row['id']; ?>"><img src="includes/images/edit-button.gif" width="16" height="18" border="0"></a>&nbsp;&nbsp;<a href="javascript:confirmation(<?php print $row['id']; ?>)"><img src="includes/images/aff_cross.gif" width="12" height="12" border="0"></a></td>
   </tr>
<?php
}
?>
 </table>
<br>
<br>
<?php
$tmpl = new tmpl;
echo $tmpl->opencontent("page/navigation/add.php");
?>