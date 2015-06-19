<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<?php
     $result5 = $conn->query("SELECT * FROM stock WHERE portfolio_id = $portfolio_id");
	 $num5=$result5->num_rows;

     $k = 0;
     $total = 0;
     while ($k < $num5) {
	$row5 = $result5->fetch_assoc();
	$stock_value = $row5['stock_value'];
	$quantity = $row5['quantity'];
	$total = $total + ($stock_value * $quantity);
	#echo "total: ".$total;
	$k++;
     }
     $total = $capital + $total;
?>
