<?php
if(!defined('SCMS')) die('Hacking attempt!');

class admin {

	function content($page) {
		$content = "page/$page/$page.php";
		return $content;
	}
	
	function run($page) {
		include $this->content($page);
	}
}
?>