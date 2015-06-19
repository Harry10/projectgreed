<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");

$result1 = $conn->query("SELECT * FROM historical_stock");
     $row = $result1->fetch_assoc();
$num=$result->num_rows;

while ($i < $num)
{
$result2 = $conn->query("DELETE FROM historical_stock WHERE hstock_id = '$i'");
$i++;
}
?>

