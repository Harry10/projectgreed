<?php
	
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<div id="comp">
<?php
$username = $_SESSION['username'];

$current = date('Y\-n\-d');

$result1 = $conn->query("SELECT * FROM competition /*WHERE winner IS NULL*/ WHERE competition_id != 8 order by date_created DESC");
$num=$result1->num_rows;
 echo "<center><table border=1></center>\n";
 echo "<th>Competition ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Created by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Entrance Fee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Lasts until&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>\n";

 $i=0;
 while ($i < $num) {
     $row1 = $result1->fetch_assoc();
     $competition_id = $row1['competition_id'];
     $username = $row1['username'];
     $fee = "$" . number_format($row1['fee'],2);

	$result = $conn->query("SELECT * FROM portfolio WHERE competition_id = $competition_id");
	$num3=$result->num_rows;
	if ($num3 < 2) {$i++; continue;}

     $date_created = $row1['date_created'];
     $duration = $row1['duration'];
     $expiration = strtotime($date_created . "+ " . $duration . " days");
     $expiration = date("Y-m-d",$expiration);

     $begins = (strtotime($date_created) - strtotime($current))/(24*60*60);
	if ($begins > 0) {$i++; continue;}

     echo "<form method='POST' action='indexmember.php?competition'><tr><td>$competition_id</td><td>$username</td><td>$fee</td><td>$expiration</td><td><input type='submit' name='view' value='View'/></td><td><input type='hidden' name='competition_id' value='$competition_id'/></td></tr></form>\n";
    $i++;
}
echo "</table>\n";

if (isset($_POST['view'])) 
{
$competition_id = $_POST['competition_id'];
    $result1 = $conn->query("SELECT * FROM portfolio WHERE competition_id = $competition_id order by capital DESC");
    $num=$result1->num_rows;
echo "</div><br><br><br><br>";

if ($num > 1)
{
echo "<h2>Competition standing:</h2>\n";
echo "<center><table border=1></center>\n";
 echo "<th>Rank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Entered portfolio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Current capital&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>\n";

 $i=1;
 while ($i <= $num) {
     $row1 = $result1->fetch_assoc();
     $username = $row1['username'];
     $portfolio_id = $row1['portfolio_id'];
     $capital = "$" . number_format($row1['capital'],2);
	echo "<tr><td>$i</td><td>$username</td><td>$portfolio_id</td><td>$capital</td></tr>";
	$i++;
 }
 echo "</table>\n";
 
} else {echo "<font color='red'>There is no one entered in this competition. Register now!</font>";}
   
}
?>

</div>
<br>
