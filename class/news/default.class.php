<?php
if(!defined('SCMS')) die('Hacking attempt!');

//default news class
class news {

	static public function showNews() {
		global $site;
		$newstpl = "";
		$temp = new tmpl;
		$sql = new sql;

		$sql->wconnect();
		$query = 'SELECT id, author, title, news, postdate FROM news ORDER BY id DESC LIMIT '.$site['news_post'];
		$result = mysql_query ($query);
		echo mysql_error();
		while ($row = mysql_fetch_assoc($result)) {
			$author 	= strip_tags( $row['author']);
			$date 		= $row['postdate'];
			$title		= strip_tags( $row['title']);
			$div		= preg_replace("/[^A-Za-z0-9]/", "", $title );
			$div		= 'a'.substr(md5($div), 0, 7);
			$content	= nl2br(strip_tags($row['news'],'<a><b><i><u>'));
			$newstpl	= $temp->fileopen('templates/'.$site['template'].'/theme/pages/news.php');
			$newsparse	= str_replace('{div}', $div, $newstpl);
			$newsparse	= str_replace('{title}', $title, $newsparse);
			$newsparse	= str_replace('{by}', $author, $newsparse);
			$newsparse	= str_replace('{date}', $date, $newsparse);
			$newsparse	= str_replace('{news}', $content, $newsparse);

			echo $temp->pharsecentertpl($newsparse);
		}
		$sql->close();
	}
}
?>