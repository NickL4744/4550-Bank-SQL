
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
 
  
 
$Acct_no = $_REQUEST['Acct_no'];

   

$sql = "SELECT * FROM `login_tbl` WHERE `userid` LIKE '%$userid' and 'pssword' LIKE '%$pssword' ";
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

  <!-- Button to go back to login.html -->
  <button class="bottom-button" onclick="window.location.href = 'login.html';">Logout</button>
</body>
</html>