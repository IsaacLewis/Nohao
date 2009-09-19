<?php
include "mysql.php";
include "function/returnWithMsg.php";

function vote($type, $score, $nohaoTagID) {
	switch ($type) {
		case "quality" :
			$table = "reviews"; 
			break;
		case "difficulty" :
			$table = "difficulty_reviews";
			break;
	}	

	// add new row to appropriate reviews table
	mysql_query("INSERT INTO `$table` (nohao_tag_id, score) VALUES ('$nohaoTagID','$score')");
		
	// calculate new score
	$reviews = mysql_query("SELECT score FROM `$table` WHERE nohao_tag_id = '$nohaoTagID'");
	$sum = 0;
	$numberReviews = mysql_num_rows($reviews);
	while ($review = mysql_fetch_array($reviews)) {
		$sum = $sum + $review['score'];
	} 
	$newScore = $sum / $numberReviews;

	// update nohao_tags table
	switch ($type) {
		case "quality" :
			mysql_query("UPDATE n_nohao_tags SET reviews = '$numberReviews'," 
			. " quality = '$newScore' WHERE id = '$nohaoTagID'");
			break;
		case "difficulty" :
			mysql_query("UPDATE n_nohao_tags SET difficulty_reviews = '$numberReviews'," 
			. " difficulty = '$newScore' WHERE id = '$nohaoTagID'");
			break;
	}
}

$score = mysql_real_escape_string($_POST['score']);
$nohaoid = mysql_real_escape_string($_POST['nohao']);
$linkid = mysql_real_escape_string($_POST['link']);
$type = mysql_real_escape_string($_POST['type']);

if ($score < 0 || $score > 5) returnWithMsg(3);

// get nohao_tag for posted data
$nohaoTagdb = mysql_query("SELECT id FROM n_nohao_tags WHERE link_id = '$linkid' AND nohao_id='$nohaoid'");
$nohaoTag = mysql_fetch_array($nohaoTagdb);
$nohaoTagID = $nohaoTag['id'];

// check user has not previously rated this link
//

vote($type, $score, $nohaoTagID);

// return
header("Location: ".$_SERVER['HTTP_REFERER']);

?>
