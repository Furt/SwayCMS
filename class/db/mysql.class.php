<?php
if(!defined('SCMS')) die('Hacking attempt!');

class sql {

	public function connect($host, $user, $pass, $db) {
		error_reporting('E_ALL ^ E_WARNING');
		$link = mysql_connect($host, $user, $pass);
		if(!$link) {
			die ('Cannot connect to Mysql Server. '.mysql_error());
		}
		$db_selected = mysql_select_db($db, $link);
		if(!$db_selected) {
			die ('Cannot select Database. '.mysql_error());
		}
		return $link;
		return $db_selected;
	}

	public function aconnect() {
		global $account;
		error_reporting('E_ALL ^ E_WARNING');
		$link = mysql_connect($account['host'], $account['user'], $account['pass']);
		if(!$link) {
			die ('Cannot connect to Mysql Server. '.mysql_error());
		}

		$db_selected = mysql_select_db($account['database'], $link);
		if(!$db_selected) {
			die ('Cannot select Database. '.mysql_error());
		}
		return $link;
		return $db_selected;
	}

	public function wconnect() {
		global $website;
		error_reporting('E_ALL ^ E_WARNING');
		$link = mysql_connect($website['host'], $website['user'], $website['pass']);
		if(!$link) {
			die ('Cannot connect to Mysql Server. '.mysql_error());
		}

		$db_selected = mysql_select_db($website['database'], $link);
		if(!$db_selected) {
			die ('Cannot select Database. '.mysql_error());
		}
		return $link;
		return $db_selected;
	}

	public function close() {
		mysql_close();
	}
}
?>