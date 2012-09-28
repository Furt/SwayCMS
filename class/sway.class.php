<?php
if(!defined('SCMS')) die('Hacking attempt!');

class sway {

	static function pagination( $url, $currentpage = 0, $toppage = 1 ) {
		$pagelinks   = "";
		$theprevpage = $currentpage - 1;
		$thenextpage = $currentpage + 1;
		$pagelinks .= "<span>";
		if ( $currentpage > 1 ) {
			$pagelinks .= "<a href='$url&page=1' title='first page'>First</a>&nbsp;";
			$pagelinks .= "<a href='$url&page=$theprevpage'>&laquo; Previous</a>&nbsp;";
		}

		$counter    = 0;
		$lowercount = $currentpage - 5;
		if ( $lowercount <= 0 )
		$lowercount = 1;

		while ( $lowercount < $currentpage ) {
			$pagelinks .= "<a href='$url&page=$lowercount'>$lowercount</a>&nbsp;";
			$lowercount++;
			$counter++;
		}

		$pagelinks .= "<strong>&nbsp;$currentpage </strong>&nbsp;";
		$uppercounter = $currentpage + 1;
		while ( ( $uppercounter < $currentpage + 10 - $counter ) && ( $uppercounter <= $toppage ) ) {
			$pagelinks .= "<a href='$url&page=$uppercounter'>$uppercounter</a>&nbsp;";
			$uppercounter++;
		}

		if ( $currentpage < $toppage ) {
			$pagelinks .= "<a href='$url&page=$thenextpage'>Next &raquo;</a>&nbsp;";
			$pagelinks .= "<a href='$url&page=$toppage' title='last page'>Last</a>&nbsp;";
		}

		$pagelinks .= "</span>";
		return $pagelinks;
	}
}