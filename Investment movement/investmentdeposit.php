<!DOCTYPE html>
<html>
<body>

Deposit Transaction <br><br>

<?php
// Connect to the server
$dbcnx = @mysqli_connect("localhost", "quickme1_4211", "csci4211");

if (!$dbcnx) {
    echo "<p>Unable to connect to the database server at this time.</p>";
    exit();
}

// Select the database
if (!@mysqli_select_db($dbcnx, "quickme1_4211")) {
    echo "<p>Unable to locate the database at this time.</p>";
    exit();
}

$accountID = '1234567890';  // Example account ID
$depositAmount = 100.00;    // Example deposit amount
$currentDate = date('Y-m-d');

// Begin transaction
mysqli_begin_transaction($dbcnx);

try {
    // Add the deposit transaction to the investments transactions table
    $query = "INSERT INTO `investments_transactions` (`accountID`, `transaction_type`, `amount`, `transaction_date`) 
              VALUES ('$accountID', 'deposit', '$depositAmount', '$currentDate')";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error adding deposit transaction: " . mysqli_error($dbcnx));
    }

    // Retrieve the current balance from the investments table
    $query = "SELECT balance FROM `investments` WHERE `accountID` = '$accountID'";
    $result = mysqli_query($dbcnx, $query);
    if (!$result) {
        throw new Exception("Error retrieving balance: " . mysqli_error($dbcnx));
    }
    $row = mysqli_fetch_assoc($result);
    $currentBalance = $row['balance'];

    // Update the balance in the investments table
    $newBalance = $currentBalance + $depositAmount;
    $query = "UPDATE `investments` SET `balance` = $newBalance WHERE `accountID` = '$accountID'";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error updating balance: " . mysqli_error($dbcnx));
    }

    // Commit the transaction
    mysqli_commit($dbcnx);
    echo "Deposit successful. Your new balance has been updated.<br>";

} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($dbcnx);
    echo "Transaction failed: " . $e->getMessage() . "<br>";
}

// Close the database connection
mysqli_close($dbcnx);

?>

</body>
</html>
