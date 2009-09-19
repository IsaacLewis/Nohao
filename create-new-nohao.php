<?php
include "mysql.php";
include "function/stripHttp.php";
include "function/verifyUrl.php";
include "function/existsInTable.php";
include "function/submitWebsite.php";
include "function/getId.php";

include "function/returnWithMsg.php";

$title = mysql_real_escape_string($_POST['title']);
// strip 'http' if it is there, then add it to all strings later
$url = stripHttp(mysql_real_escape_string($_POST['url']));
$httpUrl = "http://".$url;
$type = mysql_real_escape_string($_POST['type']);
$nohaoName = mysql_real_escape_string($_POST['nohaoName']);
$submitter = mysql_real_escape_string($_POST['submitter']);
if(!isset($submitter)) $submitter = 0;

if(existsInTable($nohaoName, "n_nohaos", "name")) {
	returnWithMsg(3);
}
if(!verifyUrl($url)) {
	returnWithMsg(1);
}
// add new record to nohaos
mysql_query("INSERT INTO n_nohaos (name) VALUES ('$nohaoName')");

// submit posted website, adding records to websites, links and nohao_tags
submitWebsite($title, $httpUrl, getId($nohaoName, "n_nohaos", "name"), $submitter);

header("Location: ".$nohaoName);
?>
