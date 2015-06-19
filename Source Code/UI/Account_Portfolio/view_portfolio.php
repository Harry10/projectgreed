<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<?php

$result1 = $conn->query("SELECT * FROM portfolio WHERE username = '$username' group by portfolio_id");

 $num=$result1->num_rows;
 echo "<h2>Portfolios owned by ".$username."</h2>";

	echo '<div id="portfolio">'; 

 echo "<table border=1>\n";
 echo "<th>Porfolio ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Portfolio Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Portfolio Value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Activation Status</th>\n";

 $i=0;
 while ($i < $num) {
     $row = $result1->fetch_assoc();
     $isActive = $row['active'];
     if ($isActive == 1){$active = "Active";}else{$active = "Inactive";}
     $portfolio_name = $row['portfolio_name'];
     $portfolio_id = $row['portfolio_id'];
     $capital = $row['capital'];
	include 'get_value.php';
     $capital = "$" . number_format($total,2);
     $username = $row['username'];

	echo "<form method='POST' action='indexmember.php?roster'><tr><td>$portfolio_id</td><td>$portfolio_name</td><td>$capital</td><td>$active</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='view' value='View Stocks'/></td></td><td><input type='hidden' name='portfolio_id' value='$portfolio_id'/></td></tr></form>\n";
$i++;
}

echo "</table>\n<br><br>";
echo '</div>'; 

?>
