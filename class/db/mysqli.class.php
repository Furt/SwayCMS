<?php
if(!defined('SCMS')) die('Hacking attempt!');

class sql {
	
	public function connect($host, $user, $pass, $db) {
		$mysqli = new mysqli($host, $user, $pass, $db, 3306);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		return $mysqli;
	}

	public function ezconnect($host, $user, $pass, $db) {
		//error_reporting('E_ALL ^ E_WARNING');
		$link = mysqli_connect($host, $user, $pass);
		if(!$link) {
			die ('Cannot connect to Mysql Server. '.mysql_error());
		}
		$db_selected = mysqli_select_db($db, $link);
		if(!$db_selected) {
			die ('Cannot select Database. '.mysqli_connect_error());
		}
		//return $link;
		return $db_selected;
	}

	public function aconnect() {
		global $account;
		$mysqli = new mysqli($account['host'], $account['user'], $account['pass'], $account['database'], 3306);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		return $mysqli;
	}

    public function wconnect() {
        global $website;
		$mysqli = new mysqli($website['host'], $website['user'], $website['pass'], $website['database'], 3306);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		return $mysqli;
    }

    public function squery( $link, $query ) {
        $qreturn = $link->query( $query );
        if(!$qreturn) {
            die ('could not query db.');
        }
        return $qreturn;
    }

    public function fetch( $result ) {
	    $fetchresult = mysqli_fetch_assoc( mysqli_result );
	    if( !$fetchresult ) {
            die ('could not fetch assoc.');
        }
	    return $fetchresult;
    }

	public function close($link) {
		mysqli_close($link);
	}
}

?>