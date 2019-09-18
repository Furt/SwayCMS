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
	$motdQuery = "SELECT * FROM motd ORDER BY id DESC LIMIT 1";
	$motdResult = $sql->squery($sql->wconnect(),$motdQuery);
	$motd = null;

	if (!$motdResult) {
		$message  = mysqli_connect_error();
		error_reporting('E_NONE');
		echo $message;
	}
	while ($motdRow = mysqli_fetch_assoc($motdResult)) {
		$motd = $motdRow['text'];
	}
	return $motd;
}

function getads() {
	$adsfile = txtopen("templates/".TEMPLATE_NAME."/theme/ads.tpl");
	$sql = new sql();
	$adq = "SELECT image, url FROM ads";
	$adres = $sql->squery($sql->wconnect(),$adq);
	$link = "";
	while ($adrow = mysqli_fetch_assoc($adres)) {
		$adimg = $adrow['image'];
		$adlink =  $adrow['url'];
		$replaceurl = str_replace("{link}", $adlink, $adsfile);
		$link .=  str_replace("{img}", $adimg, $replaceurl);
	}
	return $link;
}

?>