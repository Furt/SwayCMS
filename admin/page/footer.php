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
<center>Powered by <a href=http://swaycms.com/>SwayCMS</a> | Page Created in: <?php echo $total_time; ?> seconds</center>
</div>
</body>
</html>