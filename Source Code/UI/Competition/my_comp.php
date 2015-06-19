
<?php
session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<div id="comp">
<?php

$username = $_SESSION['username'];

$result1 = $conn->query("SELECT * FROM portfolio WHERE username = '$username'  AND competition_id != 0 order by username DESC");
$num=$result1->num_rows;

if ($num != 0) {
 echo "<center><table border=1></center>\n";
 echo "<th>Competition ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Entrance Fee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Lasts until&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Entered portfolio</th>\n";

 $i=0;
 while ($i < $num) {
     $row1 = $result1->fetch_assoc();
     $competition_id = $row1['competition_id'];
     $portfolio_id = $row1['portfolio_id'];
     
$result2 = $conn->query("SELECT * FROM competition WHERE competition_id = '$competition_id'");
     $row2 = $result2->fetch_assoc();
     $date_created = $row2['date_created'];
     $username = $row2['username'];
     $duration = $row2['duration'];
     $expiration = strtotime($date_created . "+ " . $duration . " days");
     $expiration = date("Y-m-d",$expiration);

     $fee = "$" . number_format($row2['fee'],2);

     echo "<form method='POST' action='indexmember.php?competition'><tr><td>$competition_id</td><td>$fee</td><td>$expiration</td><td>$portfolio_id</td><td>&nbsp;&nbsp;&nbsp;<input type='submit' name='withdraw' value='Withdraw'/></td><td><input type='hidden' name='competition_id' value='$competition_id'/></td></tr></form>\n";
    $i++;
}
echo "</table>\n";

if (isset($_POST['withdraw'])) 
{
$competition_id = $_POST['competition_id'];
    $result2 = $conn->query("SELECT fee FROM competition WHERE competition_id = '$competition_id'");
     $row2 = $result2->fetch_assoc();
    $fee = $row2['fee'];

$username = $_SESSION['username'];
    $result1 = $conn->query("SELECT * FROM portfolio WHERE username = '$username' AND active = 1 AND competition_id = '$competition_id'");
     $row1 = $result1->fetch_assoc();
    $portfolio_id = $row1['portfolio_id'];
    $capital = $row1['capital'];

    $balance = $fee + $capital;

    $result1 = $conn->query("UPDATE portfolio SET capital = '$balance' WHERE portfolio_id = $portfolio_id");
    $result1 = $conn->query("UPDATE portfolio SET competition_id = NULL WHERE portfolio_id = $portfolio_id");

    echo "<font color='green'>Successfully withdrew from competition " . $competition_id . "</font><br>";
}

}else {echo "<center><font color='red'>You are not entered in any competitions.</font></center><br>";}


?>
</div>
