<?php
if(!defined('SCMS')) die("Hacking attempt!");

$hlp = new tmpl;
$help = 'pages/help/helpcenter.php';
$help = $hlp->opencontent($help);
echo $hlp->pharsecentertpl($help);
?>