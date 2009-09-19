<?php
function getSearchRegexes($string) {
	// create an array of regexes, eg "cat" would return .*at, c.*t, ca.*
	
	$regexes = array();
	for($i = 0; $i < strlen($string); $i++) {
		$regexes[$i] = substr_replace($string, ".*", $i, 1);
	}
	return $regexes;
}
?>