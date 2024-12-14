<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $tracking_number = $_POST['tracking_number'];

    // Check if the tracking code has already been received
    $check_received = "SELECT status FROM transactions WHERE tracking_code = ?";
    $check_stmt = $conn->prepare($check_received);
    $check_stmt->bind_param("s", $tracking_number);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        $status = $row['status'];

        if ($status === 'received') {
            // If the tracking code has already been used, deny it and redirect to receive page
            header("Location: recieve.php?tracking_number=$tracking_number&error=used");
            exit();
        }
    }

    // Update the status and tracking code
    $update_sql = "UPDATE transactions SET status = 'received', tracking_code = ? WHERE transaction_id = ? AND status = 'pending'";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $tracking_number, $transaction_id);

    if ($update_stmt->execute()) {
        // If the tracking code is accepted, redirect to view transactions
        header("Location: view_transaction.php?tracking_number=$tracking_number");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
