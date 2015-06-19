
<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<?php #Display Stocks in portfolios

/*$data = array();
$query5 = $conn->query("SELECT * FROM historical_info WHERE portfolio_id = $portfolio_id order by date_taken ASC");
for ($n = 1; $n < 20; $n++)
{
     $row5 = $query5->fetch_assoc();
     $value = $row5['hvalue'];
     array_push($data, $value);
}
$_SESSION['data'] = $data;*/

#echo "<img src='portfolio_graph.php' /><br>";

echo '<br>
<center><h2>Stocks Purchased</h2></center>'; 

 $result = $conn->query("SELECT * FROM portfolio WHERE username = '$username' AND active = '1' group by portfolio_id");
 $row = $result->fetch_assoc();
 $portfolio_id = $row['portfolio_id'];


     $result1 = $conn->query("SELECT * FROM stock WHERE portfolio_id = '$portfolio_id' group by stock_name");
     $num1=$result1->num_rows;

if ($num1 > 0){

	echo '<div id="buystocks">';
 echo "<table border=1>\n";
 echo "<th>Porfolio ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Stock name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Last trading value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Shares</th>\n";

     $j = 0;
	while ($j < $num1)
	{
	$row1 = $result1->fetch_assoc();
	$stock_name = $row1['stock_name'];
	$stock_value = "$" . number_format($row1['stock_value'],2);
	$stock_id = $row1['stock_id'];
	$quantity = $row1['quantity'];
	echo "<form method='POST' action='indexmember.php'><tr><td>$portfolio_id</td><td>$stock_name</td><td>$stock_value</td><td>$quantity</td><td><input id='field' type='text' name='quantity'/></td><td><input type='submit' name='sell' value='Sell'/></td><td><input type='hidden' name='stock_id' value='$stock_id'/></td></tr></form>\n";
	$j++;
	}
echo "</table><br><br>";


} else {echo "<br><br><font color='red'>You have not bought any stocks.</font>";}


#Sell stocks

if (isset($_POST['sell'])) 
{
    $stock_id = $_POST['stock_id'];
    $quantity = $_POST['quantity'];
    $username = $_SESSION['username'];
   $query = "SELECT * FROM stock where stock_id = '$stock_id'";
   $result = $conn->query($query);
     $row = $result->fetch_assoc();

$newQuantity = $row['quantity'] - $quantity;

   if ($newQuantity >= 0)
   {
   $total = $row['stock_value'] * $quantity;
   $portfolio_id = $row['portfolio_id'];

   $query = "SELECT * FROM portfolio WHERE username = '$username' AND portfolio_id = '$portfolio_id'";
   $result = $conn->query($query);
     $row = $result->fetch_assoc();
   $capital = $row['capital'];

$balance = $capital + $total;

    $query = "UPDATE portfolio SET capital = '$balance' WHERE portfolio_id = '$portfolio_id'";
    $result = $conn->query($query);
    } else{echo "<font color='red'>Invalid entry. Transaction did not proceed.</font>";}

    if ($newQuantity > 0)
    {
	$result = $conn->query("UPDATE stock SET quantity = '$newQuantity' WHERE stock_id = '$stock_id'");
	echo "<font color='green'>Successful transaction.</font>";
    }
    else if ($newQuantity == 0)
    {
	$result = $conn->query("UPDATE stock SET portfolio_id = NULL WHERE stock_id = '$stock_id'");
	echo "</div><font color='green'>Successful transaction.</font>";
    }

}

?>

