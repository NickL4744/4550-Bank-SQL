<?php
   

$servername = "localhost";
$username = "quickme1_4211";
$password = "csci4211";
$dbname = "quickme1_4211";

$studentid = $_REQUEST['studentid'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
   
 

 $sql = "DELETE FROM student WHERE studentid=$studentid";
  
if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>