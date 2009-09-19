<?php
function search($table, $column, $string) {
	// find matches similar to $string in $table.$column
	
	$regexes = getSearchRegexes($string);
	$matches = array();
	// do a mysql query on $table for each regex
	foreach ($regexes as $regex) {
		$foundMatches = mysql_query("SELECT `$column` FROM `$table` WHERE `$column` REGEXP '$regex'");
		// add each returned result to $matches
		while ($match = mysql_fetch_array($foundMatches)) {
			$matches[] = $match[$column];
		}
	}
	$matches = array_unique($matches);
	sort($matches);
	return $matches;
}

include "getSearchRegexes.php";
?>