
<div id="comp">
<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>
<?php

$username = $_SESSION['username'];

$current = date('Y\-n\-d');

$result1 = $conn->query("SELECT * FROM competition /*WHERE winner IS NULL*/ order by date_created DESC");
$num=$result1->num_rows;
 echo "<center><table border=1></center>\n";
 echo "<th>Competition ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Created by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Entrance Fee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Lasts until&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>\n";

 $i=0;
 while ($i < $num) {
     $row1 = $result1->fetch_assoc();
     $date_created = $row1['date_created'];
     $duration = $row1['duration'];
     $expiration = strtotime($date_created . "+ " . $duration . " days");
     $expiration = date("Y-m-d",$expiration);

     $begins = (strtotime($date_created) - strtotime($current))/(24*60*60);

	if ($begins <= 0) {$i++; continue;}

     $competition_id = $row1['competition_id'];
     $username = $row1['username'];
     $fee = "$" . number_format($row1['fee'],2);
     echo "<form method='POST' action='indexmember.php?competition'><tr><td>$competition_id</td><td>$username</td><td>$fee</td><td>$expiration</td><td><input type='submit' name='join' value='Join'/><td>&nbsp;<input type='submit' name='view' value='View'/></td></td><td><input type='hidden' name='competition_id' value='$competition_id'/></td></tr></form>\n";
    $i++;
}
echo "</table>\n";


if (isset($_POST['join'])) 
{
$competition_id = $_POST['competition_id'];
    include 'join_competition.php';
    
}

?></div>
