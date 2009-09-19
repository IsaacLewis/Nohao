<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
include "function/search.php";
include "function/getColumn.php"; 
include "mysql.php";

$nohaoName = $_GET['nohao'];
$msgID = mysql_real_escape_string($_GET['msg']);
$msg = getColumn("message", "n_messages", "id", $msgID);

// secure name from SQL injection
$secureName = mysql_real_escape_string($nohaoName);

// check that this nohao doesn't exist
$result = mysql_query("SELECT * FROM n_nohaos WHERE name = '$nohaoName'");

if( mysql_num_rows($result) == 0) {
	?>
	<html>

	<head>
		<title><?php echo ucfirst($nohaoName); ?> Nohao</title>
		<link rel="stylesheet" type="text/css" href="nohao.css"/>
	</head>
	
	<body>
	<strong><?php echo $msg ?></strong>
	<?php
	echo "<p>Nohao doesn't have any links about ".$nohaoName.".</p>";

	// search for alternatives
	$possibleMatches = search("n_nohaos", "name", $secureName);
	if (count($possibleMatches) != 0) {
		echo "Did you want:";
		foreach ($possibleMatches as $match) {
			echo "<br><a href='".$match."'><b>".$match."</b><i>Nohao</i></a>";
		}
	}
	
	// ask to submit a link to $nohaoName
	?>
	
	<form method='post' action='create-new-nohao.php'>
		<h3>Submit a link to <?php echo $nohaoName; ?> Nohao</h3>
		Title: <input type='text' length='140' name='title' /><br/>
		URL: <input type='text' name='url' /><br/>
		<input type='hidden' name='type' value='website' />
		<input type='hidden' name='nohaoName' value='<?php echo $nohaoName; ?>' />
		<input type='submit' value='Submit!' />
	</form>
	
	</body>
	
	</html>
	
	<?php
} else header("Location: ".$nohaoName);

?>
