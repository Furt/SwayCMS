<?php
if(!defined('SCMS')) die('Hacking attempt!');

	$tmpl = new tmpl;
	if(!isset($_GET['action'])) {
		$_GET['action'] = "view";
	}
	$action = $_GET['action'];

	if($action == "view") {
		echo $tmpl->opencontent("page/modules/view.php");
	}
	if($action == "post") {
		echo $tmpl->opencontent("page/modules/post.php");
	}
	if($action == "delete") {
		echo $tmpl->opencontent("page/modules/delete.php");
	}
	if($action == "edit") {
		echo $tmpl->opencontent("page/modules/edit.php");
	}
	
	if($action == "editfinal") {
		echo $tmpl->opencontent("page/modules/editfinal.php");
	}
	
	if($action == "position") {
		echo $tmpl->opencontent("page/modules/position.php");
	}
	
	if($action == "settings") {
		echo $tmpl->opencontent("page/modules/settings.php");
	}
	
?>