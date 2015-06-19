<?php
include "login.php";
define('DB_HOST', 'pluto.hood.edu');
define('DB_NAME', 'htun');
define('DB_USER','htun');
define('DB_PASSWORD','jeiCau1a');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());


function NewUser()
{
	$username = $_POST['username'];
	$user_password =  $_POST['user_password'];
	$query = "INSERT INTO account (username,user_password) VALUES ('$username','$user_password')";
	$data = mysql_query ($query)or die(mysql_error());
	if($data)
	{
	 
	 SignIn();
	}
	else
	{
	echo "failed to register";
	}
}

function SignUp()
{
if(!empty($_POST['username']))   //checking the username which is from signuplogin.php, is it empty or have some text
{
	$query = mysql_query("SELECT * FROM account WHERE username = '$_POST[username]'") or die(mysql_error());

	if(!$row = mysql_fetch_array($query))
	{
		NewUser();
	}
	else
	{
		validation();
	}
}
}


function validation()
{
if(!empty($_POST['username']))   //checking the username which is from signuplogin.php, is it empty or have some text
{
	$query = mysql_query("SELECT * FROM account WHERE username = '$_POST[username]'") or die(mysql_error());
	if($row = mysql_fetch_array($query))
	{
		header("Location: http://pluto.hood.edu/~htun/projectgreed/index.php?signuperror");
	}
}
}

if(isset($_POST['submit']))
{
	SignUp();
}
?>



