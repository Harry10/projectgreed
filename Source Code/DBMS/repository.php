#!/usr/bin/php -q
<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

$data = $conn->query("SELECT stock_name FROM stock");
     $num=$data->num_rows;

for ($i = 1; $i < $num; $i++)
{
     $result = $data->fetch_assoc();
     $stock_list = $result['stock_name'];

$url = "http://finance.yahoo.com/d/quotes.csv?s=" . $stock_list ."&f=sl1c1&e=.csv";

$filesize = 2000;

$handle = fopen($url, "r");

$raw_quote_data = fread($handle, $filesize);

fclose($handle);

$quote_array = explode("\n", $raw_quote_data);

foreach ($quote_array as $quote_value) {

$quote = explode(",", $quote_value);

$value = $quote[1];

$query = "UPDATE stock SET stock_value = '$value' WHERE stock_name = '$stock_list'"; 
#echo $query;

$data1 = $conn->query($query);

break;

}

}

$data2 = $conn->query("SELECT * FROM portfolio");
     $num1=$data2->num_rows;

for ($i = 1; $i < $num; $i++)
{
     $current = date('Y\-n\-d H:i:s');
     $result = $data2->fetch_assoc();
     $portfolio_id = $result['portfolio_id'];
     $capital = $result['capital'];

	include 'get_value.php';

$query1 = "INSERT INTO historical_info (date_taken,hportfolio_id,hvalue) VALUES ($current,$portfolio_id,$total)"; 
#echo $query;

$data4 = $conn->query($query1);

}

if ($num > 800)
{
     $data5 = $conn->query("SELECT * FROM historical_info order by date_taken ASC");
	$result = $data2->fetch_assoc();
	$portfolio_id = $result['hportfolio_id'];
	$date_taken = $result['date_taken'];
     $data6 = $conn->query("DELETE FROM historical_info WHERE hportfolio_id = $portfolio_id AND date_taken = $date_taken");
}

?>
