<?php
define("SCMS",1);

$start = microtime();
$start = explode(' ', $start);
$start = $start[1] + $start[0];

include '../class/confedit.class.php';
include 'install.class.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Installer - Powered by SwayCMS</title>
<link type="text/css" rel="stylesheet"
	href="../admin/includes/css/style.css" />
</head>
<body>
	<div class="logo"></div>
	<div class="bar"></div>
	<ul>
		<li><a href="index.php?step=0">Restart Installer</a></li>

		<li><a href="../index.php">Cancel Installer</a></li>
	</ul>
	<div class="content">
		<center>
		<?php
		Install::Run();
		?>
		</center>
	</div>
	<div class="bar"></div>
	<div class="footer">
	<?php
	// load time
	$finish = microtime();
	$finish = explode(' ', $finish);
	$finish = $finish[1] + $finish[0];
	$total_time = round(($finish - $start), 4);
	?>
		<center>
			Powered by <a href="http://swaycms.com">SwayCMS</a> | Page Created
			in:
			<?php echo $total_time; ?>
			seconds
		</center>
	</div>
</body>
</html>
