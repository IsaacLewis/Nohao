<?php
function stripHttp($string) {
	return preg_replace('/^https?:\/\/(.*)/', '\1', $string);
}
?>