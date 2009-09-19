<?php
function returnWithMsg($id) {
	$url = $_SERVER['HTTP_REFERER']."?msg=".($id);
	$url = fixQueryString($url);
	header("Location: ".$url);
	exit("Message ID: ".$id);
}
include "fixQueryString.php";
?>
