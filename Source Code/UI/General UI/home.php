<?php
	
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}
?>

<br>
<div id="account">
<br>
<center>
<?php
include 'account.php'; 
?>
</center>
<br>
</div><!-- end account -->

<div id="stock">

<?php

#include 'end_competition.php';

?>
<br><br>
<center><h2>  Past Competitions Winners </h2></center>
<div id="comp">

<?php

include 'past_competition.php';

?>
</div>
<br><br><br>
<h2>Top Ten Stocks</h2><br>
<?php
include 'top_ten.php';
?>

<br><br><br>


</div><!-- end stock -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
