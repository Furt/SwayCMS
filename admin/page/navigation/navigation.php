<?php
if(!defined('SCMS')) die('Hacking attempt!');

	$tmpl = new tmpl;
	if(!isset($_GET['action'])) {
		$_GET['action'] = "view";
	}
	$action = $_GET['action'];

	if($action == "view") {
		echo $tmpl->opencontent("page/navigation/view.php");
	}
	if($action == "post") {
		echo $tmpl->opencontent("page/navigation/post.php");
	}
	if($action == "delete") {
		echo $tmpl->opencontent("page/navigation/delete.php");
	}
	if($action == "edit") {
		echo $tmpl->opencontent("page/navigation/edit.php");
	}
	
	if($action == "editfinal") {
		echo $tmpl->opencontent("page/navigation/editfinal.php");
	}
	
?>