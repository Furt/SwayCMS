<?php
if(!defined('SCMS')) die('Hacking attempt!');

//includes
include('includes/language/'.$site['language'].'.define.php');
include('class/db/'.$site['mysql'].'.class.php');
include('functions.inc.php');
include('class/plugins/'.$site['plugin'].'/plugin.inc.php');
include('class/modules.class.php');
include('templates/'.$site['template'].'/theme.config.php');
include('class/template.class.php');
include('class/news/'.$site['news'].'.class.php');

//session checks
if(!isset($_SESSION['user'][4])) $_SESSION['user'][4] = 'false';
?>