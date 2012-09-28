<?php
if(!defined('SCMS')) die('Hacking attempt!');

global $nquery, $sql_debug;
$nquery = 0;
$sql_debug = true;

class mysql {

	private $sql_function_level = 0;

	public function __construct( $hostname, $username, $password, $database, $persistent = false ) {
		if($persistent == true) {
			$this->db_link = mysql_pconnect( $hostname, $username, $password ) or die( mysql_error() );
			return mysql_select_db( $database ) or die ( mysql_error() );
		}
		else {
			$this->db_link = mysql_connect( $hostname, $username, $password ) or die( mysql_error() );
			return mysql_select_db( $database ) or die ( mysql_error() );
		}
	}

	public function query( $query ) {
		global $nquery, $sql_debug;
		$this->sql_function_level++;
		$nquery++;
		if( $this->result = mysql_query( $query ) ) {
			$this->sql_function_level = 0;
			return $this->result;
		}

		else
		throw new Exception($this->trace_error( $query ));

		$this->sql_function_level = 0;
	}

	public function query_array( $query ) {
		$this->sql_function_level++;
		if( $result = $this->query( $query ) ) {
			$query_array = mysql_fetch_array( $result, MYSQL_ASSOC);

			return $query_array;
		}
	}

	public function query_list( $query ) {
		$this->sql_function_level++;
		if( $result = $this->query( $query ) ) {
			$query_list = array( );
			while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
			$query_list[ ] = $row;

			return $query_list;
		}
	}

	public function query_count( $query ) {
		$this->sql_function_level++;
		return mysql_num_rows( mysql_query( $query ) );
	}

	public function nQuery( ) {
		return $GLOBALS[ 'nquery' ];
	}

	public function executeSqlFile($sql) {
		$query = explode( ";\r", $sql );
		$html = '';
		for( $i=0; $i<count($query);$i++) {
			if( !mysql_query( $query[$i] ) ) {
				$html .= ' - <font color="red">ERROR</font>';
			}
			else
			$html .= ' - OK';
			$html .= '</div>';
		}
		return $html;
	}

	public function affectedRows() {
		return mysql_affected_rows();
	}

	public function disconnect( ) {
		return mysql_close( $this->db_link );
	}

	public function sql_escape($msg) {
		if(get_magic_quotes_gpc())
		return $msg;
		else
		return @mysql_real_escape_string($msg);
	}

	private function trace_error( $query ) {
		$sql_error = mysql_error();
		$debug_array = debug_backtrace();

		$error_html = "\n" .
                "<div style=\"background-color:#f8f8ff; border: 1px solid #aaaaff; padding:10px;\">" . "\n" .
                "<font size=\"-1\">error: </font><font color=red>{$sql_error}</font><br>" . "\n" .
                "<font size=\"-1\">query: </font><i>{$query}</i><br><br>" . "\n" .
                "<font size=\"-1\">backtrace: </font><br>" . "\n" .
                "	<div style=\"background-color:#ffffff; border: 1px dotted #9999ee; padding: 10px;\">" . "\n";

		for( $i = $this->sql_function_level; $i < count( $debug_array ); $i++ ) {
			$error_html .= "<font size=\"-1\">file: </font>" . str_replace( $_SERVER[ 'DOCUMENT_ROOT' ], "", $debug_array[ $i ][ 'file' ] ) . "<br>" . "\n";
			if( isset( $debug_array[ $i ][ 'function' ] ) )
			$error_html .= "<font size=\"-1\">function: </font>{$debug_array[ $i ][ 'function' ]}<br>" . "\n";
			$error_html .= "<font size=\"-1\">line:</font> {$debug_array[ $i ][ 'line' ]}<br><br>" . "\n";
		}
		$error_html .= "</div></div><br>" . "\n";
		return $error_html;
	}
}
?>