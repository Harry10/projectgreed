<?php
	
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<?php
$result1 = $conn->query("SELECT DISTINCT stock_name,stock_value FROM stock order by stock_value DESC");

 echo "<center><table border=1></center>\n";
 echo "<th>Rank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Stock Symbol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Last Trading Value</th>\n";

 $i=1;
 while ($i < 11) {
     $row1 = $result1->fetch_assoc();
	#$row1['stock_value']
     printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n", $i, $row1['stock_name'], "$".number_format($row1['stock_value'],2));
$i++;
}
echo "</table>\n";
?>
