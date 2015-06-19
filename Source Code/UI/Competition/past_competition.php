
<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>
<?php

#Display past winners

$result1 = $conn->query("SELECT * FROM competition WHERE winner != 0 order by date_created DESC");
$num=$result1->num_rows;

 $i=0;

 echo "<center><table border=1></center>\n";
echo "<th>Competition ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Date completed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Winner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Ending Capital</th>";
 while ($i < $num) {
     $row1 = $result1->fetch_assoc();
     $competition_id = $row1['competition_id'];
     $duration = $row1['duration'];
     $expiration = strtotime($date_created . "+ " . $duration . " days");
     $expiration = date("Y-m-d",$expiration);
     $winner = $row1['winner'];
     $result3 = $conn->query("SELECT * FROM portfolio WHERE portfolio_id = '$winner'");
		$row3 = $result3->fetch_assoc();
     		$username = $row3['username'];
     		$capital = $row3['capital'];
		include 'get_value.php';
     		$capital = "$" . number_format($total,2);
     
	echo "<tr><td>$competition_id</td><td>$expiration</td><td>$username</td><td>$capital</td></tr>";
$i++;
}
echo "</table>";

?>
