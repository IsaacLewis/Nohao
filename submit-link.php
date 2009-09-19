<?php
include "mysql.php";
include "function/stripHttp.php";
include "function/verifyUrl.php";
include "function/existsInTable.php";
include "function/submitWebsite.php";
include "function/getId.php";
include "function/getColumn.php";

header("Location: ".$_SERVER['HTTP_REFERER']);

$title = mysql_real_escape_string($_POST['title']);
// strip 'http' if it is there, then add it to all strings
$url = stripHttp(mysql_real_escape_string($_POST['url']));
$httpUrl = "http://".$url;
$type = mysql_real_escape_string($_POST['type']);
$nohaoId = mysql_real_escape_string($_POST['nohaoid']);
$submitter = mysql_real_escape_string($_POST['submitter']);

if(!isset($submitter)) $submitter = 0;

echo "Creating record for url ".$url." with title ".$title.", under type ".$type." with id ".$nohaoId;

switch ($type) {
	case "website" :
		if (existsInTable($httpUrl, "n_websites", "url")) {
			// get link of existing record for that URL
			$linkId = getColumn("link_id", "n_websites", "url", $httpUrl);
			// check that the link does not currently have a tag to this nohao
			$links = mysql_query("SELECT link_id,nohao_id FROM n_nohao_tags "
			. "WHERE link_id = '$linkId' AND nohao_id = $nohaoId'");
			
			if (mysql_num_rows($links) == 0) {
				// if this link isn't already in this nohao, put it in there
				mysql_query("INSERT INTO n_nohao_tags (link_id,nohao_id) VALUES "
				. "('$linkId','$nohaoId')");
				exit("URL already in database; a link was added to this Nohao");
			} else exit("URL already submitted to this Nohao");
		}
		if (!verifyUrl($url)) exit("No page was found at that URL");
		submitWebsite($title, $httpUrl, $nohaoid, $submitter);
		break;
	
	default : break;
}


?>
