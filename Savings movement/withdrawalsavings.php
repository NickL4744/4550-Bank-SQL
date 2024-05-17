<!DOCTYPE html>
<html>
<body>

Withdrawal Transaction <br><br>

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
$withdrawalAmount = 50.00;  // Example withdrawal amount

// Begin transaction
mysqli_begin_transaction($dbcnx);

try {
    // Check if the balance is sufficient for the withdrawal
    $query = "SELECT balance FROM `savings` WHERE `accountID` = '$accountID'";
    $result = mysqli_query($dbcnx, $query);
    if (!$result) {
        throw new Exception("Error retrieving balance: " . mysqli_error($dbcnx));
    }

    $row = mysqli_fetch_assoc($result);
    $currentBalance = $row['balance'];

    if ($currentBalance < $withdrawalAmount) {
        throw new Exception("Insufficient balance for the withdrawal.");
    }

    // Add the withdrawal transaction to the savings transactions table
    $query = "INSERT INTO `savings_transactions` (`accountID`, `transaction_type`, `amount`) VALUES ('$accountID', 'withdrawal', '$withdrawalAmount')";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error adding withdrawal transaction: " . mysqli_error($dbcnx));
    }

    // Update the balance in the savings table
    $query = "UPDATE `savings` SET `balance` = `balance` - $withdrawalAmount WHERE `accountID` = '$accountID'";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error updating balance: " . mysqli_error($dbcnx));
    }

    // Commit the transaction
    mysqli_commit($dbcnx);
    echo "Withdrawal successful. Your new balance has been updated.<br>";

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
