<?php
if(!defined('SCMS')) die('Hacking attempt!');

class tmpl {

	function fileopen($file) {
		$handle = fopen($file, "r");
		$contents = fread($handle, filesize($file));
		fclose($handle);
		return $contents;
	}

	function opencontent($filename) {
		$file = $filename;
		if (is_file($file)) {
			ob_start();
			include $file;
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}
		return false;
	}

	function loginmenu($status) {
		global $site;
		$lgdin = $this->fileopen('templates/'.$site['template'].'/theme/toplogintrue.php');
		$lgdout = $this->fileopen('templates/'.$site['template'].'/theme/toploginfalse.php');

		if($status == 'true') {
			$uc = ucfirst($_SESSION['user'][1]);
			return str_replace('{Username}', $uc, $lgdin);
		}

		elseif($status == 'false') {
			return $lgdout;
		}
	}

	function ezform($name) {
		global $site;
		return $this->openpage('templates/'.$site['template'].'/theme/form/'.$name.'.php');
	}

	function pharsecentertpl($cnt) {
		global $site;
		$tpltxt = $this->fileopen('templates/'.$site['template'].'/theme/center.php');
		return str_replace("{content}", $cnt ,  $tpltxt);
	}

	function accountpage($page) {
		$p = 'pages/account/page/'.$page.'/'.$page.'.php';
		if(file_exists($p)) {
			echo $this->pharsecentertpl($this->opencontent($p));
		}else{
			echo $this->pharsecentertpl($this->opencontent('pages/account/page/menu.php'));
		}
	}

	function content($page) {
		global $site, $theme;
		$module = new module;
		$contenttpl	= $this->fileopen('templates/'.$site['template'].'/theme/content.php');
		$content	= '';

		// Open left module
		if($theme['left_mod']	== '1') {
			$content  = str_replace('{leftmenu}', $module->run('left'), $contenttpl);
		}else{
			$content  = $contenttpl;
		}

		// Open content
		if (file_exists('pages/'.$page.'/'.$page.'.php')) {
			$contnt = $this->opencontent('pages/'.$page.'/'.$page.'.php');
		}
		$content = str_replace('{centerpart}', $contnt, $content);

		// Open right module
		if($theme['right_mod'] == '1') {
			$content = str_replace('{rightmenu}', $module->run('right'), $content);
		}

		return $content;
	}

	function run() {
		global $site, $start, $theme;

		// get content page
		if(!isset($_GET['page']) || empty($_GET['page']))
		$_GET['page'] = "home";

		// parse header
		$header		= $this->fileopen('templates/'.$site['template'].'/theme/header.php');
		$header		= str_replace('{title}', $site['name'], $header);

		if($theme['topbar'] == '1') {
			if($_SESSION['user'][4] == "true") {
				$header	= str_replace('{Loginpanel}',  $this->loginmenu("true"), $header);
			}else{
				$header	= str_replace('{Loginpanel}',  $this->loginmenu("false"), $header);
			}
		}

		$header		= str_replace('{sway}', 'Powered by SwayCMS', $header);

		if($theme['motd'] == '1') {
			$header		= str_replace('{motd}', motd(), $header);
		}
		// load time
		$finish = microtime();
		$finish = explode(' ', $finish);
		$finish = $finish[1] + $finish[0];
		$total_time = round(($finish - $start), 4);

		// parse footer
		$footerinfo  = $site['name'].' &#169; All Rights Reserved. | Powered by <a href="http://swaycms.com">SwayCMS</a>';
		$footerinfo .= '<br /> Template: '.ucfirst($site['template']).' | Page Created in: '.$total_time.' seconds';
		$footer		= $this->fileopen('templates/'.$site['template'].'/theme/footer.php');
		$footer		= str_replace('{copywrite}', $footerinfo, $footer);

		// Full template
		$parsepage  = $header;
		$parsepage .= $this->content($_GET['page']);
		$parsepage .= $footer;
		return $parsepage;
	}
}
?>

