
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
<div id="logout">
<a href="logout.php">Logout</a>
</div>

<div class="menu">

<nav>
                <li><a href="indexmember.php?home">Home</a></li>
                <li><a href="indexmember.php?competition">Competition</a></li>
                <li><a href="indexmember.php?whatif">What-if Scenario</a></li>
		<li><a href="indexmember.php?roster">Roster</a></li>		
		<li><a href="indexmember.php?about">About</a></li>
 		
        </ul>
</nav>
</div>
</header>
<br>
<h1>New Age Infrastructure: Project Greed</h1>
<div class"insert">
<?php
$pagearray = array("home", "account", "competition", "whatif", "roster", "about", "signuplogin", "signuperror", "loginerror", "logout", "indexmember", "transaction");
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
<section>
<br>
<br>
<footer class "footer">
<p>New Age Infrastructure: Project Greed</p>
<sub>Copyright &copy; 2014 Devin Hill, Harryson Tun, Erik Phillips, Nathan 
Goedeke </sub>
</footer>
</section>
</body>
</html>
