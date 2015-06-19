<?php 
	
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>
<div id"wrapper">
<br>
<div id="account2">
<br><br>
<center><h2> Create Competitions </h2></center>
<br><br><br>
<div align="center">

<table border="0">
<tr>
<form method="POST" action="indexmember.php?competition">
<td>Entrance Fee</td><td> <input type="text" name="fee"></td>
</tr>
<tr>
<td>Duration (days)&nbsp;</td><td><input type="text" name="duration"></td>
</tr>
<tr>
<td>Starts In (days)&nbsp;</td><td><input type="text" name="begins"></td>
</tr>
<tr>
<td><input id="button" type="submit" name="create" value="Create"></td>
</tr>
</form>
</table>

<?php

session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

if(isset($_POST['create']))
{
    $fee = $_POST['fee'];
    $duration = $_POST['duration'];
    $begins = $_POST['begins'];
    $current = date('Y\-n\-d');
    $date_created = strtotime($current . "+ " . $begins . " days");
     $date_created = date("Y-m-d",$date_created);
    $username = $_SESSION['username'];

$result = $conn->query("SELECT * FROM competition");
$competition_id=$result->num_rows + 1;

    $query = "INSERT INTO competition (competition_id,fee,duration,date_created,username) VALUES('$competition_id','$fee','$duration','$date_created','$username')"; # if not, insert it into the database

#echo $query;

$result1 = $conn->query($query);

if($result1){ # Only deduct from the capital if the insertion/update was successful

echo "Competition successfully created<br>";

} else{echo "<font color='red'>Failed insertion</font>";}

include 'join_competition.php';

}

?>

<br><br>
<center><h2> My Competitions </h2></center>
<br>
<?php

include 'my_comp.php';
?>

</div>

<br><br><br><br><br><br>
</div><!-- end account -->

<div id="account3">

<div align="center">
<br><br>

<center><h2>  Competitions Happening Now </h2></center>

<br>
<?php
include 'newsfeed.php';
?>

<br><br><br>

<center><h2>  Upcoming Competitions </h2></center>

<br>

<?php
include 'future_comp.php';
?>

<br><br>

</div>
</div><!-- end stock -->
</div><!-- end wrapper -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br>

