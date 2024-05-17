<!DOCTYPE html>
<html>
<body>

Interest Calculation <br><br>

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

// Define the interest rate
$interestRate = 0.02;  // Example interest rate (2%)
$currentDate = date('Y-m-d');
$firstOfMonth = date('Y-m-01');

// Check if today is the first of the month
if ($currentDate === $firstOfMonth) {
    // Begin transaction
    mysqli_begin_transaction($dbcnx);

    try {
        // Retrieve all accounts and their balances
        $query = "SELECT accountID, balance FROM `investments`";
        $result = mysqli_query($dbcnx, $query);
        if (!$result) {
            throw new Exception("Error retrieving balances: " . mysqli_error($dbcnx));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $accountID = $row['accountID'];
            $currentBalance = $row['balance'];

            // Calculate the interest amount
            $interestAmount = $currentBalance * $interestRate;

            // Add the interest transaction to the investment transactions table
            $query = "INSERT INTO `investments_transactions` (`accountID`, `transaction_type`, `amount`, `transaction_date`) 
                      VALUES ('$accountID', 'interest', '$interestAmount', '$currentDate')";
            if (!mysqli_query($dbcnx, $query)) {
                throw new Exception("Error adding interest transaction: " . mysqli_error($dbcnx));
            }

            // Update the balance in the investments table
            $newBalance = $currentBalance + $interestAmount;
            $query = "UPDATE `investments` SET `balance` = $newBalance WHERE `accountID` = '$accountID'";
            if (!mysqli_query($dbcnx, $query)) {
                throw new Exception("Error updating balance: " . mysqli_error($dbcnx));
            }
        }

        // Commit the transaction
        mysqli_commit($dbcnx);
        echo "Interest calculation successful. Balances have been updated.<br>";

    } catch (Exception $e) {
        // Rollback the transaction in case of error
        mysqli_rollback($dbcnx);
        echo "Transaction failed: " . $e->getMessage() . "<br>";
    }
} else {
    echo "Today is not the first of the month. Interest calculations are only performed on the first of each month.<br>";
}

// Close the database connection
mysqli_close($dbcnx);

?>

</body>
</html>
