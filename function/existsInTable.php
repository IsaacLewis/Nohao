<?php
function existsInTable($string, $table, $column) {
	$result = mysql_query("SELECT `$column` FROM `$table` WHERE `$column` = '$string'");
	return mysql_num_rows($result);
}
?>
