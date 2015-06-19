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
    $result1 = $conn->query("SELECT * FROM portfolio WHERE username = '$username' AND active = 1");
     $row1 = $result1->fetch_assoc();
     $portfolio_id = $row1['portfolio_id'];
     $capital = $row1['capital'];

    if ($competition_id != $row1['competition_id'])
    {
    $result1 = $conn->query("SELECT fee FROM competition WHERE competition_id = '$competition_id'");
     $row1 = $result1->fetch_assoc();
     $fee = $row1['fee'];

    $balance = $capital - $fee;
    if ($balance >= 0){
	$query = "UPDATE portfolio SET competition_id = '$competition_id' WHERE portfolio_id = '$portfolio_id'";
	$result4 = $conn->query($query);
	if ($result4){
	    $query = "UPDATE portfolio SET capital = '$balance' WHERE username = '$username' AND portfolio_id = '$portfolio_id'";
	    $result3 = $conn->query($query);
	    if ($result3){
		echo "<font color='green'>Successfully joined competition " . $competition_id . "</font><br>";
	    }else {echo "<font color='red'>Failed to access account</font>";}
	}else {echo "<font color='red'>Failed insertion</font>";}
    }else {echo "<font color='red'>You do not have enough capital to enter this competition.</font>";}

    }else {echo "<font color='red'>You have already entered this competition.</font>";}
?>
