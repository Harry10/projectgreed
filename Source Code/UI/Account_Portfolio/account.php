<br>
<center>
<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<?php 

$username = $_SESSION['username'];

echo "<h2>WELCOME, " . $username ." </h2><br><br>";
?>
 
<?php 

# Display portfolios
if(!empty($username))
{
 $result = $conn->query("SELECT * FROM portfolio WHERE username = '$username' group by portfolio_id");

 $num=$result->num_rows;
	echo '<div id="portfolio">'; 

if ($num > 0){
 echo "<table border=1>\n";
 echo "<th>Porfolio ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Portfolio Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Capital&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>&nbsp;Total Value&nbsp;&nbsp;</th><th>Status</th>\n";

 $i=0;
 while ($i < $num) {
     $row = $result->fetch_assoc();
     $isActive = $row['active'];
     if ($isActive == 1){$active = "Active";}else{$active = "Inactive";}
     $portfolio_name = $row['portfolio_name'];
     $portfolio_id = $row['portfolio_id'];
     $capital = $row['capital'];
	include 'get_value.php';
     $capital = "$" . number_format($capital,2);
     $total = "$" . number_format($total,2);

	echo "<form method='POST' action='indexmember.php'><tr><td>$portfolio_id</td><td>$portfolio_name</td><td>$capital</td><td>&nbsp;&nbsp;$total</td><td>&nbsp;$active</td><td>&nbsp;&nbsp;<input type='submit' name='activate' value='Activate'/></td><td>&nbsp;<input type='submit' name='reset' value='Reset'/></td></td><td><input type='hidden' name='portfolio_id' value='$portfolio_id'/></td></tr></form>\n";
$i++;
}
}else {echo "You have not created any portfolios yet";}
echo "</table>\n<br><br>";
echo '</div>'; 

if (isset($_POST['activate'])) 
{
    $portfolio_id = $_POST['portfolio_id'];
    $conn->query("UPDATE portfolio SET active = false WHERE username = '$username'");
    $conn->query("UPDATE portfolio SET active = true WHERE username = '$username' AND portfolio_id = '$portfolio_id'");
    
}

if (isset($_POST['reset'])) 
{
    $portfolio_id = $_POST['portfolio_id'];
    $conn->query("UPDATE portfolio SET capital = '100000' WHERE username = '$username' AND portfolio_id = '$portfolio_id'");
    
}

echo "<br><form method='POST' action='indexmember.php'>Enter name of new portfolio:&nbsp;&nbsp;<input id='field' type='text' name='portfolio_name'/>&nbsp;&nbsp;<input type='submit' name='create' value='Create New Portfolio'/></form><br>\n";

if (isset($_POST['create']))
{
#echo 'name: ';

$portfolio_name = $_POST['portfolio_name'];
include 'newportfolio.php';

}

echo "<a href='http://pluto.hood.edu/~htun/projectgreed/indexmember.php?transaction'>Buy new stock</a>
<br>";

include 'sell.php';

}
else {echo "No portfolios to display. You are not signed in.";}



?>
</center>



