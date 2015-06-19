
<?php
session_start();

$_SESSION['submitted'] = true;

/*header("Location: http://pluto.hood.edu/~htun/projectgreed/indexmember.php?transaction");*/


session_start();
if($_SESSION['submitted'])
{

$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

$result = $conn->query("SELECT * FROM stock WHERE stock_name = '$_POST[symbol]'");
     $row = $result->fetch_assoc();
$stock_name = $row['stock_name'];

 echo "<center><table border=1></center>\n";
 echo "<th>Stock Symbol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Last Trading Value</th>\n";

     printf("<tr><td>%s</td><td>%s</td></tr>\n", $row['stock_name'], $row['stock_value']);

echo "</table>\n";

$_SESSION['submitted'] = false;
}



?>
