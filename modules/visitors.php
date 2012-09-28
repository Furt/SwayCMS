<?php
if(!defined('SCMS')) die('Hacking attempt!');

include_once('class/usersOnline.class.php');
$visitors_online = new usersOnline;

if ($visitors_online->count_users() == 1) {
	echo '<center>'. $visitors_online->count_users() .' visitor online</center>';
}
else {
	echo '<center>'. $visitors_online->count_users() .' visitors online</center>';
}

?>