<?php

/**************************************************
 ** Initial class by Robert Lambert for UnityCMS
 ** Code overhaul by Darko for SwayCMS
 ** no sense in reinventing the wheel ^^
 **************************************************/
session_start();
class Install {
	static $step = 0;

	static function Run() {
		if ( isset( $_GET['step'] ) )
		self::$step = $_GET['step'];

		if ( isset( $_POST ) ) {
			foreach ( $_POST as $k => $v )
			$_SESSION[$k] = $v;
		}

		if ( self::$step == 0 )
		session_unset();

		self::BuildStep( self::$step );
	}

	static function inputCreate( $label, $type, $name, $value = '' ) {
		echo "<tr>";
		echo "<td>" . $label . "</td><td><input type='" . $type . "' name='" . $name . "' value='" . $value . "'></td>";
		echo "</tr>";
	}

	static function optionCreate($label, $name, $array = '') {
		echo "<tr><td>".$label."</td><td><select name=\'".$name."\'>";

		foreach($array as $value) {
			echo "<option value=\'".$value."'\'>".$value."</option>";
		}

		echo "</select></td></tr>";
	}

	static function showMessage( $message, $color ) { echo '<b style=\'color:' . $color . '\'>' . $message . '</b><br>'; }

	static function redirect( $url, $timer = 0 ) {
		if ( $timer < 0 )
		$timer = 0;

		if ( !headers_sent() && $timer <= 0 )
		header( 'Location: ' . $url );

		echo "
        <script type=\"text/javascript\">
            setTimeout('location = \'" . $url . "\'', ($timer * 1000));
        </script>
        <noscript><meta http-equiv=\"refresh\" content=\"$timer;url=" . $url . "\" /></noscript>";

		echo "<br /><br />Now redirecting you<br />";
		echo "<a href='$url'>Click here if you do not wish to wait</a>";
	}
	static function Secure( $s ) {
		$s = htmlentities( strip_tags( $s ) );

		if ( ini_get( 'magic_quotes_gpc' ) ) { $s = stripslashes( $s ); }

		return $s;
	}

	static function executeSqlFile($sql) {
		$query = explode( ";\r", $sql );
		for( $i=0; $i<count($query);$i++) {
			if( !mysql_query( $query[$i] ) ) {
				return true;
			}
		}
		return false;
	}

	static function BuildStep( $step ) {
		$error = false;
		$next  = $step + 1;

		if ( $step == 0 ) {
			self::showMessage( "SwayCMS Installation<br />", "blue" );
			self::showMessage( "This installer will check writable files, create config, and import the cms database.", "black" );
		}

		//Step 1
		if ( $step == 1 ) {
	  if(file_exists("../includes/config.inc.php")) {
	  	if ( !is_writable( "../includes/config.inc.php" ) ) {
	  		if ( !@chmod( "../includes/config.inc.php", 0777 ) ) {
	  			self::showMessage( "We need to be able to write to the file `config.php` which is located in the directory, please chmod the file to 0777.", "red" );
	  			return;
	  		}
	  	}
	  }

	  self::showMessage( "File checks have been completed, we will now proceed to the next step", "green" );
	  self::redirect( "index.php?step=$next", 2 );
	  return;
		}

		//Step 2
		if ( $step == 2 ) {
			if ( isset( $_POST['submit'] ) ) {
				$site_host = $_POST['site_host'];
				$site_user = $_POST['site_user'];
				$site_pass = $_POST['site_pass'];
				$site_db   = $_POST['site_db'];

				$con       = @mysql_connect( $site_host, $site_user, $site_pass );

				if ( mysql_error() ) {
					self::showMessage( "Could not open a connection to the mysql service<br />Please double check the information you provided..", "red" );
					self::redirect( "index.php?step=$step", 2 );
					return;
				}

				$db = @mysql_select_db( $site_db, $con );

				if ( mysql_error() ) {
					mysql_close( $con );
					self::showMessage( "Could not open a connection to the database<br />Please double check the information you provided..", "red" );
					self::redirect( "index.php?step=$step", 2 );
					return;
				}

				self::showMessage( "Successfully opened a connection to the mysql service.", "green" );
				$sql = file_get_contents('swaycms.sql');
				if(self::executeSqlFile($sql) == true) {
					self::showMessage( "<br />Successfully created necessary tables.", "green" );
					self::redirect( "index.php?step=$next", 2 );
					return;
				}
				else {
					mysql_close( $con );
					self::showMessage( "<br />Failed to create necessary tables.. mysql returned the following: " . mysql_error(), "red" );
					return;
				}
			}
			else {
				echo '<b>Site Database Connection information</b>';
				echo '<table><form method=\'post\' action=\'?step=2\'>';

				self::inputCreate( 'Hostname', 'text', 'site_host' );
				self::inputCreate( 'Username', 'text', 'site_user' );
				self::inputCreate( 'Password', 'password', 'site_pass' );
				self::inputCreate( 'Database', 'text', 'site_db' );

				echo '</table><input type=\'submit\' name=\'submit\' value=\'Continue\'></form><br>';
				return;
			}
		}

		//Step 3
		if ( $step == 3 ) {
			if ( isset( $_POST ) && isset( $_POST['totalrealms'] ) ) {
				self::redirect( "index.php?step=$next", 0 );
				return;
			}

			echo '<b>Account\'s Database Connection information</b>';
			echo '<table><form method=\'post\' action=\'?step=3\'>';

			self::inputCreate( 'Hostname', 'text', 'accounts_host' );
			self::inputCreate( 'Username', 'text', 'accounts_user' );
			self::inputCreate( 'Password', 'password', 'accounts_pass' );
			self::inputCreate( 'Database', 'text', 'accounts_db' );
	  self::optionCreate('Database Structure', 'accounts_core', $cores = array('default', 'mangos'));
	  self::inputCreate( 'Number of Realms', 'text', 'totalrealms', 0 );

	  echo '</table><input type=\'submit\' name=\'submit\' value=\'Continue\'></form><br>';
	  return;
		}

		//Step 4
		if ( $step == 4 ) {
			$realmid = 0;
			 
	  if($_SESSION['totalrealms'] == 0) {
	  	self::showMessage( "<br />No realm count skipping realm data.", "green" );
		  $error = true;
		  self::redirect( "index.php?step=$next", 2 );
	  } else {

	  	if ( isset( $_POST ) && isset( $_POST['realmid'] ) ) {
	  		$realmid = $_POST['realmid'];
	  		unset( $_SESSION['submit'] );
	  		unset( $_SESSION['realmid'] );

	  		foreach ( $_POST as $k => $v ) {
	  			$_SESSION[$k . "_" . $realmid] = $v;
	  			unset( $_SESSION[$k] );
	  		}

	  		$realmid += 1;
	  		if ( $realmid >= $_SESSION['totalrealms'] ) {
	  			self::redirect( "index.php?step=$next", 0 );
	  			return;
	  		}
	  	}

	  	echo '<b>Character\'s ' . ( $realmid + 1 ) . ' Database Connection information</b>';
	  	echo '<table><form method=\'post\' action=\'?step=4\'>';

	  	self::inputCreate( 'Realm Name', 'text', 'characters_name' );
	  	self::inputCreate( 'Hostname', 'text', 'characters_host' );
	  	self::inputCreate( 'Username', 'text', 'characters_user' );
	  	self::inputCreate( 'Password', 'password', 'characters_pass' );
	  	self::inputCreate( 'Database', 'text', 'characters_db' );
	  	self::optionCreate('Database Structure', 'characters_core',  $cores = array('default', 'mangos'));
	  	self::inputCreate( 'Max Player Count', 'text', 'characters_pcount', 0 );
	  	self::inputCreate( '', 'hidden', 'realmid', $realmid );

	  	echo '</table><input type=\'submit\' name=\'submit\' value=\'Continue\'></form><br>';
	  	return;
	  }}

	  //Step 5
	  if ( $step == 5 ) {
	  	$error = true;

	  	if ( isset( $_POST ) && isset( $_POST['sitename'] ) ) {
	  		self::redirect( "index.php?step=$next", 0 );
	  		return;
	  	}

	  	echo '<h1>Site Information</h1>';
	  	echo '<table><form method=\'post\' action=\'?step=5\'>';

	  	self::inputCreate( 'Site Name', 'text', 'sitename' );
	  	self::optionCreate('News Plugin', 'news_plugin', $news = array('default', 'smf - not installed'));
	  	self::inputCreate( 'News Posts', 'text', 'news_post' );
	  	$themes = array('default', 'sway');
	  	echo "<tr><td>Theme</td><td><select name=\'theme\'>";
	  	echo "<option value=\'default\'>default</option>";
	  	echo "<option value=\'blah\'>blah</option>";
	  	echo "</select></td></tr>";
	  	self::optionCreate('Language', 'language', $lang = array('english', 'blah'));
	  	self::inputCreate( 'Forum Link', 'text', 'forum_link' );

	  	echo '</table><input type=\'submit\' name=\'submit\' value=\'Continue\'></form><br>';
	  }

	  if ( $step == 6 ) {
	  	$confedit = new ConfigEditor();
	  	if(file_exists('../includes/config.inc.php')) {
	  		$confedit->LoadFromFile('../includes/config.inc.php');
	  	}
	  	$confedit->SetVar('site', array('name'		=> $_SESSION['sitename'],
										'template'	=> $_SESSION['theme'],
										'news'		=> $_SESSION['news_plugin'],
										'news_post'	=> $_SESSION['news_post'],
										'plugin'	=> $_SESSION['accounts_core'],
										'language'	=> $_SESSION['language'],
										'forum'		=> $_SESSION['forum_link']
	  	), 'Site Options');

	  	$confedit->SetVar('website', array('host' => $_SESSION['site_host'], 'user' => $_SESSION['site_user'], 'pass' => $_SESSION['site_pass'], 'database' => $_SESSION['site_db']), 'Website database');
	  	$confedit->SetVar('account', array('host' => $_SESSION['accounts_host'], 'user' => $_SESSION['accounts_user'], 'pass' => $_SESSION['accounts_pass'], 'database' => $_SESSION['accounts_db']), 'Account database');
	  	$config_php = $confedit->Save('../includes/config.inc.php');
	  	@chmod("../config.php", 0644);
	  	if ( is_writable( "../includes/config.inc.php" ) ) {
	  		self::showMessage( "The config.php file no longer needs to be chmod 0777, we recommend you change it to 0644 to prevent others from editting the file.", "red" );
	  	}
	  	self::redirect( "index.php?step=$next", 2 );
	  	return;
	  }

	  //Step 7
	  if ( $step == '7' ) {
	  	// Installation complete
	  	self::showMessage( "Installation is now complete, you will now be redirected to home page of the site.", "blue" );
	  	self::showMessage( "<br />At this time you should rename or remove /install/index.php for security reasons.", "green" );
	  	self::redirect( "../index.php", 15 );
	  	return;
	  }

	  if ( !$error ) { echo '<br><a href=\'?step=' . $next . '\'>You may continue to the next step</a>'; }
	}
}
?>