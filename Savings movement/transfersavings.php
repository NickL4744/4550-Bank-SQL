<!DOCTYPE html>
<html>
<body>

Transfer Transaction <br><br>

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

$accountID = '1234567890';        // Example account ID from which the transfer is made
$recipientAccountID = '0987654321'; // Example recipient account ID
$transferAmount = 75.00;          // Example transfer amount

// Begin transaction
mysqli_begin_transaction($dbcnx);

try {
    // Check if the balance is sufficient for the transfer
    $query = "SELECT balance FROM `savings` WHERE `accountID` = '$accountID'";
    $result = mysqli_query($dbcnx, $query);
    if (!$result) {
        throw new Exception("Error retrieving balance: " . mysqli_error($dbcnx));
    }

    $row = mysqli_fetch_assoc($result);
    $currentBalance = $row['balance'];

    if ($currentBalance < $transferAmount) {
        throw new Exception("Insufficient balance for the transfer.");
    }

    // Add the transfer transaction to the savings transactions table for the sender
    $query = "INSERT INTO `savings_transactions` (`accountID`, `transaction_type`, `amount`) VALUES ('$accountID', 'transfer', '$transferAmount')";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error adding transfer transaction: " . mysqli_error($dbcnx));
    }

    // Decrease the balance in the sender's savings table
    $query = "UPDATE `savings` SET `balance` = `balance` - $transferAmount WHERE `accountID` = '$accountID'";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error updating sender's balance: " . mysqli_error($dbcnx));
    }

    // Commit the transaction
    mysqli_commit($dbcnx);
    echo "Transfer successful. Your new balance has been updated.<br>";

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
