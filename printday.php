<!DOCTYPE html>
<html>
<body>

Daily Banking Summary <br><br>

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

$currentDate = date('Y-m-d');

// Print summary for checking account
echo "<b>Checking Account Summary for $currentDate</b><br>";
$query = "SELECT * FROM `checking_transactions` WHERE `transaction_date` = '$currentDate'";
$results = mysqli_query($dbcnx, $query);
if (!$results) {
    echo "Error retrieving checking transactions: " . mysqli_error($dbcnx) . "<br>";
} else {
    echo "<u>Transactions:</u><br>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo "Transaction ID: " . $row['transactionID'] . ", Type: " . $row['transaction_type'] . ", Amount: $" . $row['amount'] . "<br>";
    }
    // Calculate and print interest accrued for checking account
    $checkingInterest = calculateCheckingInterest($dbcnx, $currentDate);
    echo "Interest Accrued: $" . $checkingInterest . "<br>";
}

// Print summary for savings account
echo "<br><b>Savings Account Summary for $currentDate</b><br>";
$query = "SELECT * FROM `savings_transactions` WHERE `transaction_date` = '$currentDate'";
$results = mysqli_query($dbcnx, $query);
if (!$results) {
    echo "Error retrieving savings transactions: " . mysqli_error($dbcnx) . "<br>";
} else {
    echo "<u>Transactions:</u><br>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo "Transaction ID: " . $row['transactionID'] . ", Type: " . $row['transaction_type'] . ", Amount: $" . $row['amount'] . "<br>";
    }
    // Calculate and print interest accrued for savings account
    $savingsInterest = calculateSavingsInterest($dbcnx, $currentDate);
    echo "Interest Accrued: $" . $savingsInterest . "<br>";
}

// Print summary for investments account
echo "<br><b>Investments Account Summary for $currentDate</b><br>";
$query = "SELECT * FROM `investments_transactions` WHERE `transaction_date` = '$currentDate'";
$results = mysqli_query($dbcnx, $query);
if (!$results) {
    echo "Error retrieving investments transactions: " . mysqli_error($dbcnx) . "<br>";
} else {
    echo "<u>Transactions:</u><br>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo "Transaction ID: " . $row['transactionID'] . ", Type: " . $row['transaction_type'] . ", Amount: $" . $row['amount'] . "<br>";
    }
    // Calculate and print interest accrued for investments account
    $investmentsInterest = calculateInvestmentsInterest($dbcnx, $currentDate);
    echo "Interest Accrued: $" . $investmentsInterest . "<br>";
}

// Function to calculate interest accrued for the checking account
function calculateCheckingInterest($dbcnx, $date) {
    // Assume interest calculation logic here based on the current date and checking account balance
    // For example:
    $interest = 50.00; // Replace this with actual interest calculation
    return $interest;
}

// Function to calculate interest accrued for the savings account
function calculateSavingsInterest($dbcnx, $date) {
    // Assume interest calculation logic here based on the current date and savings account balance
    // For example:
    $interest = 75.00; // Replace this with actual interest calculation
    return $interest;
}

// Function to calculate interest accrued for the investments account
function calculateInvestmentsInterest($dbcnx, $date) {
    // Assume interest calculation logic here based on the current date and investments account balance
    // For example:
    $interest = 100.00; // Replace this with actual interest calculation
    return $interest;
}

// Close the database connection
mysqli_close($dbcnx);

?>

</body>
</html>
