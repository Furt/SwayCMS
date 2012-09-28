<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql();
$sql->wconnect();
$query = "SELECT * FROM menu WHERE id = '".$_GET['id']."'";
$result = mysql_query($query);

if (!$result) {
    $message  = mysql_error();
	error_reporting('E_NONE');
    echo $message;
}
while ($row = mysql_fetch_assoc($result)) {
?>

<style type="text/css">
<!--
.Formtext {
	font-size: 12px;
	font-family: Tahoma, Geneva, sans-serif;
}
.inputitems {
border:1px; 
font-size:15px; 
border-width:1px; 
border-style:solid; 
border-color:#999;
background-color:#666; 
color:#FFF; 
width:50%; 
font-size:12px; 
font-family:'Times New Roman', Times, serif;	
}
-->
 </style>
 
 <center>
   <table width="500px" align="center" border="0" cellspacing="0" cellpadding="3"><form method="post" action="?page=navigation&action=editfinal&id=<?php echo $_GET['id']; ?>">
      <tr>
      <td width="30%" align="right">Name</td>
      <td width="1%">&nbsp;:&nbsp;</td>
      <td width="69%" class="Formtext"><input name="name" type="text" class="inputitems" value="<?php echo $row['name']; ?>" width="150"  height="15"/></td>
    </tr>
	<tr>
      <td align="right">Link</td>
      <td width="1%">&nbsp;:&nbsp;</td>
      <td class="Formtext"><input name="link" type="text" class="inputitems" value="<?php echo $row['page']; ?>" width="150"  height="15"/>
    </tr>
    <tr>
      <td class="formtext" align="center" colspan="3"><input name="submit" type="submit" class="" value="Edit"  /></td>
    </tr></form>
  </table><br />
</center>
<?php
}
?>
