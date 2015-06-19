<br>
<div id="whatif">
<br>
<h2>What if? Scenarios</h2><br>

<br>
<div id="search">
<form method="POST" action="indexmember.php?whatif">
<td>How much money would I have if I bought </td>
<td><input type="text" name="quantity"></td>
<td> shares of <td>
<td><input type="text" name="symbol"></td>
<td> stock on this date: <td><br><br>

<select name="day">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>

<td> (day) <td>

<select name="month">
  <option value="0">January</option>
  <option value="1">February</option>
  <option value="2">March</option>
  <option value="3">April</option>
  <option value="4">May</option>
  <option value="5">June</option>
  <option value="6">July</option>
  <option value="7">August</option>
  <option value="8">September</option>
  <option value="9">October</option>
  <option value="10">November</option>
  <option value="11">December</option>
</select>

<td> (month) <td>

<select name="year">
  <option value="2001">2001</option>
  <option value="2002">2002</option>
  <option value="2003">2003</option>
  <option value="2004">2004</option>
  <option value="2005">2005</option>
  <option value="2006">2006</option>
  <option value="2007">2007</option>
  <option value="2008">2008</option>
  <option value="2009">2009</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014" selected>2014</option>
</select>

<td> (year) </td><br><br>
<td><input id="button" type="submit" name="submit" value="GO!"></td>
<br><br>
</form>
</div>
<br>

<?php

session_start();
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}

if(isset($_POST['submit']))
{
    $stock_name = $_POST['symbol'];
    $quantity = $_POST['quantity'];
    $year = "&c=" . $_POST['year'] . "&f=" . $_POST['year'];
    $month = "&a=" . $_POST['month'] . "&d=" . $_POST['month'];
    $day = "&b=" . $_POST['day'] . "&e=" . $_POST['day'];
    
#Example: http://ichart.finance.yahoo.com/table.csv?s=GOOGL&c=2012&f=2012&a=3&d=3&e=12&b=12&g=d&ignore=.csv

$url = "http://ichart.finance.yahoo.com/table.csv?s=" . $stock_name . $year . $month . $day . "&g=d&ignore=.csv";

#echo $url . "<br>";

$filesize = 2000;

$handle = fopen($url, "r");

$raw_quote_data = fread($handle, $filesize);

fclose($handle);

$quote_array = explode("\n", $raw_quote_data);

foreach ($quote_array as $quote_value) {

$quote = explode(",", $quote_value);

$value = $quote[2];

$data1 = $conn->query($query);

if ($value == "High")
{continue;}

break;

}

#echo "Value: " . $value;

if ($value != 0)
{

$result1 = $conn->query("SELECT stock_value FROM stock WHERE stock_name = '$stock_name'");
     $row = $result1->fetch_assoc();
$newValue = $row['stock_value'];

$balance = $newValue - $value;
$balance = $quantity * $balance;

if ($balance > 0)
{
    echo $stock_name . " value at selected date: $" . number_format($value,2) . ". Stock value now: $" . number_format($newValue,2) . ". If you purchased " . $quantity . " shares, you would have gained $" . number_format($balance,2) . ". So sorry!<br>";
}
else if ($balance < 0)
{
    $balance = -1 * $balance;
    echo $stock_name . " value at selected date: $" . number_format($value,2) . ". Stock value now: $" . number_format($newValue,2) . ". If you purchased " . $quantity . " shares, you would have lost $" . number_format($balance,2) . ". Good decision!<br>";
}
else
{
    echo $stock_name . " value at selected date: $" . number_format($value,2) . ". Stock value now: $" . number_format($newValue,2) . ". You would not have gained or lost any money. Well okay then.<br>";
}

} else {echo "No values to display. This could be because:<ul><br><li>The inputed date was invalid</li><li>This date was before the stock existed</li><li>The stock market was closed on this day.</li></ul><br>";}

}

?>
<br><br><br>
</div>
