<?php
function getId($string, $table, $column) {
	$result = mysql_query("SELECT id FROM `$table` WHERE `$column` = '$string'");
	$row = mysql_fetch_array($result);
	return $row['id'];
}
?>