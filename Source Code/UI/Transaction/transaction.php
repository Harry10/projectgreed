<br>
<div id="transaction">
<br><br>
<h2>Select Stock to Buy</h2><br>
<br>
<div id="search">
<form method="POST" action="indexmember.php?transaction">
<td>Enter stock symbol</td><td> <input type="text" name="symbol"></td>
</tr>
<tr>
<td><input id="button" type="submit" name="submit" value="Select"></td>
</tr>
<br><br>
</form>
<br>
<a href='stocklist.php' target="_blank">View All Stocks</a>
</div>
<br>

<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

if(isset($_POST['submit']))
{

$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

$result1 = $conn->query("SELECT * FROM stock WHERE stock_name = '$_POST[symbol]'");
     $row = $result1->fetch_assoc();
$_SESSION['stock_name'] = $row['stock_name'];
$_SESSION['stock_value'] = $row['stock_value'];

if ($_SESSION['stock_value'] != 0 ){
 echo "<form method='POST' action='indexmember.php?transaction'>
<center><table border=1></center>\n
<th>Stock Symbol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Last Trading Value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Number of Shares</th>\n

<tr><td>" . $_SESSION['stock_name'] . "</td><td>" . '$' . number_format($_SESSION['stock_value'],2) . "</td><td><input id='field' type='text' name='quantity'></td><td><input id='button' type='submit' name='buy' value='Buy'></td></tr>\n

</table></form><br>\n";

echo "<h3>Progress over the last year:</h3><br>";

echo "<img src = 'http://chart.finance.yahoo.com/z?s=" . $_SESSION['stock_name'] . "&t=1y&q=l&l=on&z=s&p=m30'/>";

} else{echo "<font color='red'>Cannot find stock. Try again</font>";}

}
if(isset($_POST['buy']))
{

$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

$username = $_SESSION['username'];
$total = $_POST['quantity'] * $_SESSION['stock_value'];

$result = $conn->query("SELECT * FROM stock");
$stock_id=$result->num_rows + 1;

$result = $conn->query("SELECT * FROM portfolio WHERE username = '$username' AND active = 1");
     $row = $result->fetch_assoc();
$capital = $row['capital'];

$balance = $capital - $total;
$portfolio_id = $row['portfolio_id'];
$quantity = $_POST['quantity'];
$stock_name = $_SESSION['stock_name'];
$stock_value = $_SESSION['stock_value'];


$result2 = $conn->query("SELECT * FROM stock WHERE stock_name = '$stock_name' AND portfolio_id = '$portfolio_id'");
     $row2 = $result2->fetch_assoc();
     $num=$result2->num_rows;

if ($balance >= 0){

if($num == 0){   #Check if user already owns this stock
$query = "INSERT INTO stock (stock_name,stock_value,portfolio_id,quantity,stock_id) VALUES('$stock_name','$stock_value','$portfolio_id','$quantity','$stock_id')"; # if not, insert it into the database

#echo $query;

$result1 = $conn->query($query);
}
else{
$newQuantity = $row2['quantity'] + $quantity; # if so, just add the number of shares into the quantity
$query = "UPDATE stock SET quantity = '$newQuantity' WHERE stock_name = '$stock_name' AND portfolio_id = '$portfolio_id'";

$result1 = $conn->query($query);
}

if($result1){ # Only deduct from the capital if the insertion/update was successful
$result = $conn->query("UPDATE portfolio SET capital = '$balance' WHERE portfolio_id = '$portfolio_id'");

echo "<font color='green'>Bought " . $quantity . " shares of " . $stock_name . " at $" . number_format($stock_value,2) . " per share. Total cost: $" . $total . "</font>";

} else{echo "<font color='red'>Failed insertion</font>";}

} else{echo "<font color='red'>You do not have enough capital to purchase this stock. Transaction failed.</font>";}

}
?>
<br><br><br><br><br><br>
</div>
