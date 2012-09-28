<?php
 /******************************************************************************
  * Copyright (C) 2010 SwayCMS <http://swaycms.com/>
  * Admin Panel
  * Developed by: Darko (darko@swaycms.com)
  ******************************************************************************/
session_start();
define('SCMS',1);

//get time
$start = microtime();
$start = explode(' ', $start);
$start = $start[1] + $start[0];

//debugging
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log','error_log.txt');
error_reporting(E_ALL);

// init
require_once("../includes/config.inc.php");
require_once("includes/init.php");

// check admin status
$plugin = new plugin;
$plugin->checkAdmin();

$admin = new admin;
if(empty($_GET['page'])) {
	$_GET['page'] = 'main';
}
include('page/header.php');
include('page/menu.php');
$admin->run($_GET['page']);
include('page/footer.php');
?>