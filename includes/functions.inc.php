<?php
if(!defined('SCMS')) die("Hacking attempt!");

function folderlist($startdir){

	$ignoredDirectory[] = '.';
	$ignoredDirectory[] = '..';
	if (is_dir($startdir)){
		if ($dh = opendir($startdir)){
			while (($folder = readdir($dh)) !== false){
				if (!(array_search($folder,$ignoredDirectory) > -1)){
					if (filetype($startdir . $folder) == "dir"){
						$directorylist[$startdir . $folder]['name'] = $folder;
					}
				}
			}
			closedir($dh);
		}
	}
	return($directorylist);
}

function motd() {
	$sql = new sql();
	$sql->wconnect();
	$motdQuery = "SELECT * FROM motd ORDER BY id DESC LIMIT 1";
	$motdResult = mysql_query($motdQuery);

	if (!$motdResult) {
		$message  = mysql_error();
		error_reporting('E_NONE');
		echo $message;
	}
	while ($motdRow = mysql_fetch_assoc($motdResult)) {
		$motd = $motdRow['text'];
	}
	return $motd;
}

function getads() {
	$adsfile = txtopen("templates/".TEMPLATE_NAME."/theme/ads.tpl");
	$sql = new sql();
	$sql->wconnect();
	$adq = "SELECT image, url FROM ads";
	$adres = mysql_query ($adq);
	$link = "";
	while ($adrow = mysql_fetch_assoc($adres)) {
		$adimg = $adrow['image'];
		$adlink =  $adrow['url'];
		$replaceurl = str_replace("{link}", $adlink, $adsfile);
		$link .=  str_replace("{img}", $adimg, $replaceurl);
	}
	return $link;
}

?>