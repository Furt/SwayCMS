<?php
if(!defined('SCMS')) die('Hacking attempt!');

	$tmpl = new tmpl;
	if(!isset($_GET['action'])) {
		$_GET['action'] = "view";
	}
	$action = $_GET['action'];

	if($action == "view") {
		echo $tmpl->opencontent("page/news/view.php");
	}
	if($action == "post") {
		echo $tmpl->opencontent("page/news/post.php");
	}
	if($action == "delete") {
		echo $tmpl->opencontent("page/news/delete.php");
	}
	if($action == "edit") {
		echo $tmpl->opencontent("page/news/edit.php");
	}
	
	if($action == "editfinal") {
		echo $tmpl->opencontent("page/news/editfinal.php");
	}
	
	if($action == "settings") {
		echo $tmpl->opencontent("page/news/settings.php");
	}
	
?>