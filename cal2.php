<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];

    // Query to fetch fee structure based on the entered amount
    $sql = "SELECT * FROM fee_structure WHERE amount_from <= $amount AND amount_to >= $amount";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $feePercentage = $row['fee_percentage'];

        // Calculate transaction fee and total amount
        $transactionFee = $amount * ($feePercentage / 100);
        $totalAmount = $amount + $transactionFee;

        // Display the total amount to be charged
        echo json_encode(array(
            'transactionAmount' => $amount,
            'transactionFee' => $transactionFee,
            'totalAmount' => $totalAmount
        ));
        exit;
    } else {
        echo json_encode(array('error' => 'No fee structure found for the entered amount'));
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Calculator</title>
    <script>
        function calculateTotalAmount() {
            var amount = document.getElementById('amount').value;

            // Make an AJAX request to calculate the total amount
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "transaction.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        document.getElementById('result').innerHTML = response.error;
                    } else {
                        document.getElementById('result').innerHTML = "Transaction Amount: " + response.transactionAmount + "<br>" +
                            "Transaction Fee: " + response.transactionFee + "<br>" +
                            "Total Amount to be Charged: " + response.totalAmount + "<br>";
                    }
                }
            };
            xhr.send("amount=" + amount);
        }
    </script>
</head>
<body>
    <h2>Calculate Transaction Fee</h2>
    <label for="amount">Enter Amount:</label>
    <input type="number" id="amount" name="amount" required onkeyup="calculateTotalAmount()">
    <div id="result"></div>
</body>
</html>