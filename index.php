<?php
/******************************************************************************
 * Copyright (C) 2010 SwayCMS <http://swaycms.com/>
 * Gaming Content Management System
 * Developed by: Terry Earnheart (furt1337@live.com)
 ******************************************************************************/
session_start();
define('SCMS',1);

// check to see if the cms is installed
if(!file_exists('includes/config.inc.php')){
	header( "Location: ./install/index.php" );
}

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
require_once('includes/config.inc.php');
require_once('includes/base.inc.php');

// start template
global $tmpl;
$tmpl = new tmpl;
echo $tmpl->run();
?>