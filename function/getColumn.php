<?php
function getColumn($targetColumn, $table, $searchColumn, $string) {
	// echo "<br>Searching ".$table.$searchColumn." that matches ".$string." and given ya ".$targetColumn;
	$result = mysql_query("SELECT `$targetColumn` FROM `$table` WHERE `$searchColumn` = '$string'");
	if (mysql_num_rows($result) != 0) {
		$row = mysql_fetch_array($result);
		return $row[$targetColumn];
	} else return false;
}
?>