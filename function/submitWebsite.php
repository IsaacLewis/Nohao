<?php
function submitWebsite($title, $url, $nohaoid, $submitter) {
	// add website to next available id in websites
	$websiteId = getNextFreeID("n_websites");
	$linkId = getNextFreeID("n_links");	
	mysql_query("INSERT INTO n_websites (id,link_id,url,title) VALUES ('$websiteId','$linkId','$url','$title')");
	
	// add new record to next available id in links
	mysql_query("INSERT INTO n_links (id,content_id,type,submitter_id) VALUES "
	. "('$linkId','$websiteId','website','$submitter')");
	
	// add new record to nohao_tags
	mysql_query("INSERT INTO n_nohao_tags (link_id,nohao_id) VALUES "
	. "('$linkId','$nohaoid')");
}

include "getNextFreeID.php";
?>
