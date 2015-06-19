<?php
session_start();
define('DB_HOST', 'pluto.hood.edu');
define('DB_NAME', 'htun');
define('DB_USER','htun');
define('DB_PASSWORD','jeiCau1a');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

function SignIn()
{
session_start();   //starting the session for user profile page
if(!empty($_POST['username']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysql_query("SELECT *  FROM account where username = '$_POST[username]' AND user_password = '$_POST[user_password]'") or die(mysql_error());
	$row = mysql_fetch_array($query);
	if(!empty($row['username']) AND !empty($row['user_password']))
	{
		$_SESSION['username'] = $row['username'];

		header("Location: http://pluto.hood.edu/~htun/projectgreed/indexmember.php");

	}
	else
	{
		header("Location: http://pluto.hood.edu/~htun/projectgreed/index.php?loginerror");
	}
}
}
if(isset($_POST['submit']))
{
	SignIn();
}

?>

