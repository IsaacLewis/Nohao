<?php
function fixQueryString($url) {
	$arguments = explode("?", $url);
	foreach ($arguments as $i => $arg) {
		switch ($i) {
			case 0 : $newUrl = $arg; break;
			case 1 : $newUrl = $newUrl."?".$arg; break;
			default : $newUrl = $newUrl."&".$arg; break;
		}
	}
	return $newUrl;
}
?>
