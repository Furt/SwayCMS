<?php
if(!defined('SCMS')) die("Hacking attempt!");

?>
<div class="nwshead"></div>
<?php
$home_news = new news;
$home_news->showNews();
?>
