<?php
session_start();

define('DB_HOST', 'pluto.hood.edu');
define('DB_NAME', 'htun');
define('DB_USER','htun');
define('DB_PASSWORD','jeiCau1a');

$username = $_SESSION['username'];

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$result = mysql_query("SELECT * FROM portfolio");
$portfolio_id = 1 + mysql_num_rows($result);

mysql_query("set foreign_key_checks=0;");
$query = "INSERT INTO portfolio (username,portfolio_id,capital,active,portfolio_name) VALUES ('$username','$portfolio_id',100000,false,'$portfolio_name')"; 
$data = mysql_query ($query)or die(mysql_error());

#header("Location: http://pluto.hood.edu/~htun/projectgreed/indexmember.php");
$conn->close();

?>

