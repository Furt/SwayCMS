<?php
if(!defined('SCMS')) die("Hacking attempt!");

global $plugin;
$plugin = new plugin;

if($_SESSION['user'][4] == "false") {
	/*	if($_GET['function'] != "login") {

	$tmpl = new tmpl;
	echo $tmpl->pharsecentertpl($tmpl->loginform());

	if(Empty($plugin->send_error) || $plugin->head == true){
	print '<meta http-equiv="refresh" content="5;url=index.php?pageid=account">';
	foreach($plugin->send_error as $er){
	print $er.'<br />';
	}
	}else{
	foreach($plugin->send_error as $er){
	print $er.'<br />';
	}
	}
	}
	*/
}

if($_GET['function'] == "login") {

	$plugin->login($_POST['username'],$_POST['password']);

	if(Empty($plugin->send_error) || $plugin->head == true){
		print '<meta http-equiv="refresh" content="1;url=index.php?page=account">';
		foreach($plugin->send_error as $er){
			print $er.'<br />';
		}
	}else{
		print '<meta http-equiv="refresh" content="3;url=index.php">';
		foreach($plugin->send_error as $er){
			print $er.'<br />';
		}
	}
}

if($_GET['function'] == "logout") {

	session_unset();
	session_destroy();
	?>
<script type="text/javascript">
	<!--
	window.location = "index.php"
	//-->
	</script>
	<?php
}
// all ucp features added here.
if($_SESSION['user'][4] == "true") {
	$acc = new tmpl;
	$acc->accountpage($_GET['p']);
}
?>