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
<hr>
  <form method='post' action='create-new-nohao.php'>
    <h3>Create new Nohao</h3>
    Topic: <input type='text' name='nohaoName' />
    <br>
    <b>Submit a link to your new Nohao: </b><br>
    Title: <input type='text' length='140' name='title' /><br/>
    URL: <input type='text' name='url' /><br/>
    <input type='hidden' name='type' value='website' />
    <input type='submit' value='Submit!' />
  </form>
</body>
</html>
