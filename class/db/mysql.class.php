<?php
if(!defined('SCMS')) die('Hacking attempt!');

class sql {

	public function connect($host, $user, $pass, $db) {
		error_reporting('E_ALL ^ E_WARNING');
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
		error_reporting('E_ALL ^ E_WARNING');
		$link = mysqli_connect($account['host'], $account['user'], $account['pass']);
		if(!$link) {
			die ('Cannot connect to Mysql Server. '.mysqli_connect_error());
		}

		$db_selected = mysqli_select_db($link, $account['database']);
		if(!$db_selected) {
			die ('Cannot select Database. '.mysqli_connect_error());
		}
		//return $link;
		return $db_selected;
	}

	public function zconnect() {
		global $website;
		error_reporting('E_ALL ^ E_WARNING');
		$link = mysqli_connect($website['host'], $website['user'], $website['pass']);
		if(!$link) {
			die ('Cannot connect to Mysql Server. '.mysqli_connect_error());
		}

		$db_selected = mysqli_select_db($link, $website['database']);
		if(!$db_selected) {
			die ('Cannot select Database. '.mysqli_connect_error());
		}
		//return $link;
		return $db_selected;
	}

    public function wconnect() {
        global $website;
        //error_reporting('E_ALL ^ E_WARNING');
        $link = mysqli_connect($website['host'], $website['user'], $website['pass']);
        if(!$link) {
            die ('Cannot connect to Mysql Server. '.mysqli_connect_error());
        }

        $db_selected = mysqli_select_db($link, $website['database']);
        if(!$db_selected) {
            die ('Cannot select Database. '.mysqli_connect_error());
        }
        return $link;
        //return $db_selected;
    }

    public function squery( $link, $query ) {
        $qreturn = mysqli_query( $link, $query );
        if(!$qreturn) {
            die ('could not query db.');
        }
        return $link;
    }

    public function fetch( $result ) {
	    $fetchresult = mysqli_fetch_assoc( mysqli_result );
	    if( !$fetchresult ) {
            die ('could not fetch assoc.');
        }
	    return $fetchresult;
    }

	public function close() {
		mysqli_close();
	}
}

?>