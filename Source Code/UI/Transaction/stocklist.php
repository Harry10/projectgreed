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
$result = $conn->query("SELECT DISTINCT stock_name,stock_value FROM stock order by stock_name");

 $num=$result->num_rows;
	echo '<div id="portfolio">'; 
 echo "<a href = 'indexmember.php?transaction'>Return to previous page</a><br><br><br>";

 echo "<h2>All Stocks</h2>";

 echo "<table border=1>\n";
 echo "<th>Stock Symbol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Stock Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Stock value</th>\n";

 $i=0;
 while ($i < $num) {
     $row = $result->fetch_assoc();
     $stock_name = $row['stock_name'];
     $stock_value = "$" . number_format($row['stock_value'],2);

$url = "http://finance.yahoo.com/d/quotes.csv?s=" . $stock_name ."&f=n&e=.csv";

$filesize = 2000;

$handle = fopen($url, "r");

$raw_quote_data = fread($handle, $filesize);

fclose($handle);

$quote_array = explode("\n", $raw_quote_data);

foreach ($quote_array as $quote_value) {

$quote = explode(",", $quote_value);

$value = $quote[0];

break;

}
	echo "<tr><td>$stock_name</td><td>$value</td><td>$stock_value</td></tr>\n";
$i++;
}

echo "</table>\n";
echo '</div><br><br><br>';
?>

</p>
</center> 
<br> 
</div> 
<br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br>
<br><br><br><br>
