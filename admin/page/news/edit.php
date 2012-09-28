<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql();
$sql->wconnect();
$query = "SELECT * FROM news WHERE id = '".$_GET['id']."'";
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
width:100%; 
font-size:12px; 
font-family:'Times New Roman', Times, serif;	
}
-->
 </style><center>
 <?php
 $replaceBr1 = str_replace("<Br>", " 
", $row['news']);
 $replaceBr2 = str_replace("<br>", " 
", $replaceBr1);
 $replaceBr3 = str_replace("<br />", " 
", $replaceBr2);
 ?>
 
  <table width="90%" border="0" cellspacing="0" cellpadding="3"><form method="post" action="?page=news&action=editfinal&id=<?php echo $_GET['id']; ?>">
      <tr>
      <td width="30%" align="right">Headline</td>
      <td width="1%">&nbsp;:&nbsp;</td>
      <td width="69%" class="Formtext"><input name="title" type="text" class="inputitems" value="<?php echo $row['title']; ?>" width="150"  height="15"/></td>
    </tr>
    <tr>
      <td align="right">News</td>
      <td width="1%">&nbsp;:&nbsp;</td>
      <td class="Formtext"><textarea name="news"  class="inputitems"  rows="6" cols="24" width="100%" style="width:100%"><?php echo $replaceBr3; ?></textarea></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td class="formtext"><input name="button" type="submit" class="inputitems" value="Edit News -&gt;&gt;"  /></td>
    </tr></form>
  </table><br />
</center>
<?php
}
?>
