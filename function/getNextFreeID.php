<?php
function getNextFreeID($table) {
	$maxIdDb = mysql_query("SELECT MAX(id) FROM `$table`");
	$maxId = mysql_fetch_array($maxIdDb);
	$newId = $maxId['MAX(id)'] + 1;
	return $newId;
}
?>