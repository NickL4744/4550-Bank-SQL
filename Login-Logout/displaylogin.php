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
 
  
  
  $sql = "SELECT *  FROM login_tbl";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "UserID: " . $row["userid"]. "Password: " . $row["pssword"]. "Lastname: " . $row["lastname"]. 
    "First Name: " . $row["firstname"]. "Address: " . $row["address"]. "Phone: " . $row["phone"]. "email: " . $row["email"].
     "Test Question: " . $row["Testquestion"]. "Test Answer: " . $row["Testanswer"]. "User Type: " . $row["usertype"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>
