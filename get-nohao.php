<?php
include "mysql.php";
include "function/getColumn.php";

function formatNohaoTag($tag) {
	// get link from tag
	$linkdb = mysql_query("SELECT * FROM n_links WHERE id = '" . $tag['link_id'] . "'");
	$link = mysql_fetch_array($linkdb);

	// format link
	echo "\r<div>";
	switch ($link['type']) {
		case "website" : 
			// get website info from db and output url
			$websitedb = mysql_query("SELECT * FROM n_websites WHERE "
		. " id = '" . $link['content_id'] . "'");
		$website = mysql_fetch_array($websitedb);
		echo "<a href='".$website['url']."'>".$website['title']."</a>";
		break;
		
		case "default" : echo "<p>Nohao can't format link id ".$link['id']."</p>";
	}
	
	echo " <span class='smalltext'>Rated ".$tag['quality']." after ".$tag['reviews']." votes</span>";
	?>	
	<form method='post' action='vote.php'>
		<select name='score'>
			<option>0</option>	
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
		<input type='hidden' name='nohao' value='<?php echo $tag['nohao_id']; ?>' />
		<input type='hidden' name='link' value='<?php echo $link['id']; ?>' />	
		<input type='hidden' name='type' value='quality' />
		<input type='submit' value='Rate' />
	</form>

	<form method='post' action='vote.php'>
		<select name='score'>
			<option value='0'>Introduction</option>	
			<option value='1'>Beginner</option>
			<option value='2'>Intermediate</option>
			<option value='3'>Advanced</option>
		</select>
		<input type='hidden' name='nohao' value='<?php echo $tag['nohao_id']; ?>' />
		<input type='hidden' name='link' value='<?php echo $link['id']; ?>' />	
		<input type='hidden' name='type' value='difficulty' />
		<input type='submit' value='Rate' />
	</form>
	</div>
	<?php
}

$nohaoName = $_GET['nohao'];
$msgID = mysql_real_escape_string($_GET['msg']);
$msg = getColumn("message", "n_messages", "id", $msgID);

// secure name from SQL injection
$secureName = mysql_real_escape_string($nohaoName);
$result = mysql_query("SELECT * FROM n_nohaos WHERE name = '$nohaoName'");

if(mysql_num_rows($result) == 1) {

	?>
	<html>

	<head>
		<title><?php echo ucfirst($nohaoName); ?> Nohao</title>

		<link rel="stylesheet" type="text/css" href="nohao.css"/>

		<script type="text/javascript">
		function popup() {
		alert("OMG lrn2javascript");
		}
		</script>
	</head>

	<body>

	<h1><b style='color:990000'><?php echo $nohaoName; ?></b><span class='Nohao'>Nohao</span></h1>
	
	<h3>Nohao gives you know-how. Learn skills from books, videos, and the web.</h3>
	
	<strong><?php echo $msg ?></strong>
	
	<br>
	<?php

	$nohao = mysql_fetch_array($result);
	$nohaoID = $nohao['id'];

	echo "<h2>Introduction</h2>";

	$tags = mysql_query("SELECT * FROM n_nohao_tags WHERE difficulty <= 0.5 "
	. " AND nohao_id = '$nohaoID' ORDER BY quality DESC");
	while ($tag = mysql_fetch_array($tags)) formatNohaoTag($tag);

	echo "<hr /><h2>Beginner</h2>";

	$tags = mysql_query("SELECT * FROM n_nohao_tags WHERE difficulty > 0.5 AND difficulty <= 1.5"
	. " AND nohao_id = '$nohaoID' ORDER BY quality DESC");
	while ($tag = mysql_fetch_array($tags)) formatNohaoTag($tag);	

	echo "<hr /><h2>Intermediate</h2>";

	$tags = mysql_query("SELECT * FROM n_nohao_tags WHERE difficulty > 1.5 AND difficulty <= 2.5"
	. " AND nohao_id = '$nohaoID' ORDER BY quality DESC");
	while ($tag = mysql_fetch_array($tags)) formatNohaoTag($tag);	

	echo "<hr / ><h2>Advanced</h2>";

	$tags = mysql_query("SELECT * FROM n_nohao_tags WHERE difficulty > 2.5 AND difficulty <= 3"
	. " AND nohao_id = '$nohaoID' ORDER BY quality DESC");
	while ($tag = mysql_fetch_array($tags)) formatNohaoTag($tag);		
	?>
	
	<hr />

	<form method='post' action='submit-link.php'>
		<h3>Submit Link to <?php echo $nohaoName; ?> Nohao</h3>
		Title: <input type='text' length='140' name='title' /><br/>
		URL: <input type='text' name='url' /><br/>
		<input type='hidden' name='type' value='website' />
		<input type='hidden' name='nohaoid' value='<?php echo $nohao['id']; ?>' />
		<input type='submit' value='Submit!' />
	</form>
	
	<div onclick=popup()>Mouseover Me!</div>
	</body>

	</html>
	<?php
} else header("Location: not-found.php?nohao=".$nohaoName);

?>




