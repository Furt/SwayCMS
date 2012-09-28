<?php
if(!defined('SCMS')) die('Hacking attempt!');

class module {

	function gather($name, $link) {
		global $site;
		$module = new tmpl;
		$parse  = '';
		$image  = '';
		$menu	= $module->fileopen('templates/'.$site['template'].'/theme/menu.php');
		$link	= $module->opencontent($link);
		if(is_file("templates/".$site['template']."/images/menu/".$name.".png")) {
			$image = "<img src='templates/".$site['template']."/images/menu/".$name.".png' alt='".$name."' />";
		}else{
			$image = $name;
		}
		$menu	= str_replace("{title}", $image,  $menu);
		$parse .= str_replace("{mcontent}", $link,  $menu);
		$parse .= '<br />';
		return $parse;
	}

	function run($align) {
		$sql = new sql;
		$sql->wconnect();
		$mods = "SELECT * FROM module ORDER BY m_position ASC";
		$mods = mysql_query ($mods);
		echo mysql_error();
		$run = '<br />';
		echo $br;

		while ($row = mysql_fetch_array($mods)) {
			// selects modules for the needed position.
			if($row['m_alignment'] == $align) {
				// making sure there enabled.
				if($row['m_enabled'] == '1') {
					$run .= $this->gather($row['m_name'], $row['m_link']);
				}
			}
		}
		$sql->close();
		return $run;
	}
}
?>