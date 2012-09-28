<?php
if(!defined('FCMS')) die("Hacking attempt!");

// just more snippets will bring everything together later
// for encrypting downloads
$filename	= $row['name'];
$myFile		= $row['link'];

$mm_type="application/octet-stream";

header("Cache-Control: public, must-revalidate");
header("Pragma: hack"); // WTF? oh well, it works...
header("Content-Type: " . $mm_type);
header('Content-Disposition: attachment; filename="'.md5($filename).'"');
header("Content-Transfer-Encoding: binary\n");

readfile($myFile);

// to get file size
function size($fd)
{
	$meta_data = stream_get_meta_data($fd);
	foreach($meta_data['wrapper_data'] as $response)
	if (preg_match('#^Content-Length\s*:\s*(\d+)$#i', $response,$m))
	return (int)$m[1];
	return null;
}
$fd=fopen($url,'r');
echo 'Size: ',Size($myFile),' bytes';