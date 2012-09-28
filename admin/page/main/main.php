<?php
echo 'Welcome to the main index of the Admin panel.';
echo '<br><br>';
$dir1 = '../modules/';
$dir2 = '../templates/';
$modules = count(glob("" . $dir1 . "*.php"));
echo '<u>CMS Statistics</u><br>';
echo "Modules: $modules <br>";
$dirs=0;
$dir2 = '../templates/';
$y=scandir($dir2);
foreach($y as $z){
   if(is_dir($z)){
      $dirs++;
   }
}
echo "Themes: $dirs";
?>