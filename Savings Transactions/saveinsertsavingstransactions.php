<html>

<body>

 

 

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
 
   

 

   

   // get the variables from the URL request string

   $transid = $_REQUEST['transid'];

   $trans_type = $_REQUEST['trans_type'];

   $trans_date = $_REQUEST['trans_date'];

   $trans_amount = $_REQUEST['trans_amount'];

    $lastname = $_REQUEST['lastname'];

    $firstname = $_REQUEST['firstname'];

    $phone = $_REQUEST['phone'];

    

   $sql = "INSERT INTO savings_transactions (transid, trans_type, trans_date, trans_amount, lastname, firstname, phone)
VALUES ('$transid', '$trans_type', '$trans_date', '$trans_amount', '$lastname', '$firstname', '$phone')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


 

</body>

</html>
