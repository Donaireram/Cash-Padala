<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_lastname = $_POST['s_lastname'] ?? '';
    $s_middlename = $_POST['s_middlename'] ?? '';
    $s_contact = $_POST['s_contact'] ?? '';
    $s_address = $_POST['s_address'] ?? '';
    $r_lastname = $_POST['r_lastname'] ?? '';
    $r_middlename = $_POST['r_middlename'] ?? '';
    $r_contact = $_POST['r_contact'] ?? '';
    $r_address = $_POST['r_address'] ?? '';
    $branch_id = $_POST['branch_id'] ?? '';
    $branch_from = $_POST['branch_from'] ?? '';
    $receiver_id = $_POST['receiver_id'] ?? '';
    $sender_id = $_POST['sender_id'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $fee = $_POST['fee'] ?? '';
    $purpose = $_POST['purpose'] ?? '';

    $sql_insert = "INSERT INTO transactions (sender_id, receiver_id, amount, fee, branch_from, branch_to, s_lastname, s_middlename, s_contact, s_address, r_lastname, r_middlename, r_contact, r_address, purpose) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt_insert = $conn->prepare($sql_insert);

    // Bind parameters to the statement
    $stmt_insert->bind_param(
        "iiidiisssssssss",
        $sender_id,
        $receiver_id,
        $amount,
        $fee,
        $branch_from,
        $branch_id,
        $s_lastname,
        $s_middlename,
        $s_contact,
        $s_address,
        $r_lastname,
        $r_middlename,
        $r_contact,
        $r_address,
        $purpose
    );

    if ($stmt_insert->execute()) {
        header("Location: send1.php");
        exit();
    } else {
        echo "Error: " . $stmt_insert->error;
    }
}
?>
