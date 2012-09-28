<?php
if(!defined('SCMS')) die('Hacking attempt!');
?>
 <center>Add Link<br>
   <table width="500px" align="center" border="0" cellspacing="0" cellpadding="3"><form method="post" action="?page=navigation&action=post">
      <tr>
      <td width="30%" align="right">Name</td>
      <td width="1%">&nbsp;:&nbsp;</td>
      <td width="69%" class="Formtext"><input name="name" type="text" value="" width="150"  height="15"/></td>
    </tr>
	<tr>
      <td align="right">Link</td>
      <td width="1%">&nbsp;:&nbsp;</td>
      <td class="Formtext"><input name="link" type="text" class="inputitems" value="?page=" width="150"  height="15"/>
    </tr>
    <tr>
      <td class="formtext" align="center" colspan="3"><input name="submit" type="submit" value="Submit"  /></td>
    </tr></form>
  </table><br />
</center>