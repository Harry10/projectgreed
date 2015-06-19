<br><br> 
<div id="whatif"> 
<center>
<br> 
<p>

<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<?php 

#Displays all accounts

$result = $conn->query("SELECT * FROM account group by username");

 $num=$result->num_rows;
	

 echo "<h2>All Users</h2>";
echo '<div id="portfolio">'; 
 echo "<table border=1>\n";
 echo "<th>Username&nbsp</th>\n";

 $i=0;
 while ($i < $num) {
     $row = $result->fetch_assoc();
     $username = $row['username'];

	echo "<form method='POST' action='indexmember.php?roster'><tr><td>$username</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='view_portfolio' value='View Portfolios'/></td></td><td><input type='hidden' name='username' value='$username'/></td></tr></form>\n";
$i++;
}

echo "</table>\n";
echo '</div><br><br><br>'; 

#Displays portfolios in account

if (isset($_POST['view_portfolio'])){
$username = $_POST['username'];
$_SESSION['this_user'] = $username;

include 'view_portfolio.php';

}

#Displays stocks in portfolio

if (isset($_POST['view'])) 
{
$username = $_SESSION['this_user'];
include 'view_portfolio.php';

    $portfolio_id = $_POST['portfolio_id'];
    $result1 = $conn->query("SELECT * FROM stock WHERE portfolio_id = '$portfolio_id' order by stock_value DESC");
    $num=$result1->num_rows;
echo "<h2>Stocks in portfolio ".$portfolio_id."</h2>";

echo "<table border=1>\n";
 echo "<th>Stock name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Last trading value</th>\n";

     $j = 0;
	while ($j < $num)
	{
	$row1 = $result1->fetch_assoc();
	$stock_name = $row1['stock_name'];
	$stock_value = "$" . number_format($row1['stock_value'],2);
	$stock_id = $row1['stock_id'];
	echo "<form method='POST' action='indexmember.php'><tr><td>$stock_name</td><td>$stock_value</td></tr></form>\n";
	$j++;
	}
echo "</table><br><br>";

}

?>

</p>
</center> 
<br> 
</div> 
<br>
