<html>
<head>
<title>Nohao - get know-how
</title>
<link rel="stylesheet" type="text/css" href="nohao.css"/>
</head>
<body>
<h1 class='Nohao'>Nohao</h1>
<h3><span class='Nohao' style='font-size:110%'>Nohao</span> gives you know-how. Learn skills from books, videos, and the web.</h3>
<?php
include "mysql.php";
$query = "SELECT name FROM n_nohaos ORDER BY name";
$result = mysql_query($query);
while ($nohao = mysql_fetch_array($result)) {
	echo "<div><a href='".$nohao['name']."'><b>".$nohao['name']."</b><i>Nohao</i></a></div>";
}
?>
</body>
</html>
