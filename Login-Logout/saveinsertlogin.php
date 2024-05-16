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


    $userid = $_REQUEST['userid'];

    $pssword = $_REQUEST['pssword'];

    $lastname = $_REQUEST['lastname'];

    $firstname = $_REQUEST['firstname'];

    $address = $_REQUEST['address'];

    $phone = $_REQUEST['phone'];

    $email = $_REQUEST['email'];

    $Testquestion = $_REQUEST['Testquestion'];

    $Testanswer = $_REQUEST['Testanswer'];

    $usertype = $_REQUEST['usertype'];

      

    $sql = "INSERT INTO login_tbl (userid, pssword, lastname, firstname, address, phone, email, Testquestion, Testanswer, usertype)
VALUES ('$userid', '$pssword', '$lastname', '$firstname', '$address', '$phone', '$email', '$Testquestion', '$Testanswer', '$usertype')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


 

</body>

</html>
