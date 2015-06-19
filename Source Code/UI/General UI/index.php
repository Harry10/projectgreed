
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>NAI Project Greed</title>
<link href="style.css" rel="stylesheet">
</head>

<body>
<?php include 'ticker.php' ?>
<br>
<header>
<div id="signlog">
&nbsp;&nbsp;&nbsp;
<a href="index.php?signuplogin">Signup/Login</a></div>





<div class="menu">
<nav>
        <ul>
                <li><a href="index.php?home">Home</a></li>
                <li><a href="index.php?signuplogin">Competition</a></li>
                <li><a href="index.php?signuplogin">What-if Scenario</a></li>
		<li><a href="index.php?signuplogin">Roster</a></li>
		<li><a href="index.php?about">About</a></li>
        </ul>
</nav>
</div>
</header>
<br>
<h1>New Age Infrastructure: Project Greed</h1>
<div class"insert">
<?php
$pagearray = array("home", "account", "competition", "whatif", "about", "signuplogin", "signuperror", "loginerror", "logout", "indexmember", "transaction", "roster");
 $which = $_SERVER["QUERY_STRING"];
if ( $which == "")
{
 include "home.php";
}
 else if ( in_array($which, $pagearray) )
{
  include $which . '.php';
}
else {
 echo "The page is not available.";
}
?>
</div> <!-- end insert -->
<br><br>
<section>
<footer>
<p>New Age Infrastructure: Project Greed</p>
<sub>Copyright &copy; 2014 Devin Hill, Harryson Tun, Erik Phillips, Nathan 
Goedeke </sub>
</footer>
</section>
</body>
</html>
