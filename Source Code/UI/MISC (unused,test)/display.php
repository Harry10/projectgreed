<!DOCTYPE html>
<html>
 <head>
  <title>Display 2</title>
 </head>
 <style type="text/css">
   th {color: maroon;
   background-color: silver;}
 </style>
</head>
<body>
<div style = "width:30%; float:left">
<?php include 'index.html'; ?>
</div>

<?php 
$conn = new mysqli("pluto.hood.edu", "htun", "jeiCau1a", "htun");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit();
}


$result = $conn->query("SELECT * FROM portfolio WHERE username = $username group by portfolio_id");


 $num=$result->num_rows;

 echo "<table border=1>\n";
 echo "<tr><th>Porfolio Number</th><th>Capital</th><th>Activation status</th></tr>\n";

 $i=0;
 while ($i < $num) {
     $row = $result->fetch_assoc();
     printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row['portfolio_id'], $row['capital'], $row['active']);
$i++;
}
echo "</table>\n";
$conn->close();

?>
</body>
</html>
