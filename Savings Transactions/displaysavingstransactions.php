<html>
<body>


Results of Bank Database<br><br>

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
 
  
  
  $sql = "SELECT *  FROM savings_transactions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Transaction ID: " . $row["transid"]. "Transaction Type: " . $row["trans_type"]. "Transaction Date: " . $row["trans_date"]. 
    "Transaction Amount: " . $row["trans_amount"]. "Last Name: " . $row["lastname"]. "First Name: " . $row["firstname"]. "Phone: " . $row["phone"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>
