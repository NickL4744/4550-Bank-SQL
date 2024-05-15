
<?php

$servername = "localhost";
$username = "quickme1_4211";
$password = "csci4211";
$dbname = "dbvpny1qngaxgp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
 
  
 
$transid = $_REQUEST['transid'];

   

$sql = "SELECT * FROM `investment_transactions` WHERE `transid` LIKE '%$transid'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Transaction ID: " . $row["transid"]. "<br>";
    echo "Transaction Type: " . $row["trans_type"]. "<br>";
    echo "Transaction Date: " . $row["trans_date"]. "<br>";
    echo "Transaction Amount: " . $row["trans_amount"]. "<br>";
    echo "Last Name: " . $row["lastname"]. "<br>";
    echo "First Name: " . $row["firstname"]. "<br>";
    echo "Phone: " . $row["phone"]. "<br>";
    echo "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

