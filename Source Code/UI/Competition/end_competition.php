<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>
<?php
#Check for finished competitions

$result1 = $conn->query("SELECT * FROM competition WHERE winner IS NULL order by date_created DESC");
$num=$result1->num_rows;

 $i=0;
 while ($i < $num) {
     $row1 = $result1->fetch_assoc();
     $date_created = $row1['date_created'];
#echo "Date_created: " . $date_created;
     $duration = $row1['duration'];
#echo "Duration: " . $duration;
     $length = abs(strtotime($current) - strtotime($date_created))/(24*60*60);
#echo "Length: " . $length;
     $competition_id = $row1['competition_id'];
     $fee = $row1['fee'];

     if ($duration <= $length)
     {
	$result3 = $conn->query("SELECT portfolio_id FROM portfolio WHERE competition_id = '$competition_id' order by capital DESC");
		$row3 = $result3->fetch_assoc();
     		$winner = $row3['portfolio_id'];
	$conn->query("UPDATE competition SET winner = $winner WHERE competition_id = '$competition_id'");

	$result2 = $conn->query("SELECT * FROM portfolio WHERE competition_id = '$competition_id'");
	$num1=$result2->num_rows;
 	    $j=0;
	    while ($j < $num1) {
		$row2 = $result2->fetch_assoc();
		$portfolio_id = $row2['portfolio_id'];
		$capital = $row2['capital'];
		$balance = $fee + $capital;

		$result4 = $conn->query("UPDATE portfolio SET capital = '$balance' WHERE portfolio_id = '$portfolio_id'");
		$result4 = $conn->query("UPDATE portfolio SET competition_id = NULL WHERE portfolio_id = '$portfolio_id'");
		$j++;
	    }
     }
     $i++;
}
?>
