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

$transid = '1234567890';  // Example account ID
$trans_amount = 100.00;    // Example deposit amount

// Begin transaction
mysqli_begin_transaction($dbcnx);

try {
    // Add the deposit transaction to the checking transactions table
    $query = "INSERT INTO `checking_transactions` (`transid`, `transaction_type`, `trans_amount`) VALUES ('$transid', 'deposit', '$trans_amount')";
    if (!mysqli_query($dbcnx, $query)) {
        throw new Exception("Error adding deposit transaction: " . mysqli_error($dbcnx));
    }

    // Update the balance in the checking table
    $query = "UPDATE `checking` SET `balance` = `balance` + $trans_amount WHERE `transid` = '$transid'";
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
