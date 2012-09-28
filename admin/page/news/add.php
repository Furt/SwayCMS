<?php
if(!defined('SCMS')) die('Hacking attempt!');
?>

<form name="submit" method="post" enctype="application/x-www-form-urlencoded" action="?page=news&action=post">
<center><table>
<tr>
<td align="right">Author: </td>
<td><input type="text" name="author" value="<?php echo ucwords($_SESSION['user'][1]); ?>" onfocus="this.blur();"></td>
</tr>
<tr>
<td align="right">Title: </td>
<td><input type="text" name="title" ></td>
</tr>
<tr>
<td align="right">News: </td><td>
<textarea name="news" rows="6" cols="50" ></textarea></td>
</tr>
</table>
<input type="submit" name="submit" value="Add" class="button" />
</center></form>