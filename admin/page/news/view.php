<?php
if(!defined('SCMS')) die('Hacking attempt!');

$sql = new sql;
$sql->wconnect();
	
$resultsPerPage =20;
$pageNum=(int)$_GET['pageNum'];
$limitStart = $pageNum*$resultsPerPage;

$limit = "LIMIT {$limitStart}, {$resultsPerPage}";
$query = "SELECT * FROM news ORDER BY id DESC {$limit}";
$result = mysql_query($query);
$count2 = $_GET['start'];
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
		window.location = "?page=news&action=delete&id="+ID;
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
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Headline</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Author</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Date</td>
    <td id="navprimary" width="100" align="center" style="background-image:url(includes/images/netbar.jpg); color:#000000;  border-bottom:1px #F60 dotted;border-top:1px #F60 dotted">Options</td>
   </tr>
 <?php
while ($row = mysql_fetch_assoc($result)) {
?>
  <tr class="txt">
    <td align="center" class="userlist"><span class="userlist"><font  class="txt"><?php echo $row['id']; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['title']; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['author']; ?></span></td>
    <td align="center" class="userlist"><span class="userlist"><?php echo $row['postdate']; ?></span></td>
    <td align="center" class="txt"><a href="?page=news&action=edit&id=<?php echo $row['id']; ?>"><img src="includes/images/edit-button.gif" width="16" height="18" border="0"></a>&nbsp;&nbsp;<a href="javascript:confirmation(<?php print $row['id']; ?>)"><img src="includes/images/aff_cross.gif" width="12" height="12" border="0"></a></td>
   </tr>
<?php
}
?>
 </table>
<p align="right">
<center>
<?php
$query2 = "SELECT count(id) AS result_count FROM news";
$result2 = mysql_fetch_assoc(mysql_query($query2));
$numResults = $result2['result_count']/20;
$numPages = floor($numResults);
$pageRange = range(0,$numPages);

$pageLinks = array();
foreach($pageRange as $pageNum){
	$pageLinks[] = "<a href='?page=news&pageNum=".$pageNum."'>".($pageNum+1)."</a>";
}
$pageLinks = implode('<font class=readlink2>,</font>',$pageLinks);

if(empty($_GET['pageNum'])) {
	
} else {
	if($_GET['pageNum'] == "0") {
	
	} else {
		$backlnk = $_GET['pageNum']-1;
		echo "<a href=?page=news&pageNum=".$backlnk."> << </a> ";
	}
}
echo $pageLinks;

if(empty($_GET['pageNum'])) {
		echo "<a href='?page=news&pageNum=1'> >> </a> ";
	} else {
		if($_GET['pageNum'] == $numPages) {
	} else {
		$nextlnk = $_GET['pageNum']+1;
		echo "<a href='?page=news&pageNum=".$nextlnk."'> >> </a> ";
	}
}

?>
</center>
<br>
<br>
<br>
<br>
<?php
$tmpl = new tmpl;
echo $tmpl->opencontent("page/news/add.php");
?>