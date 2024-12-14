<?php
include 'connect.php';

if(isset($_GET['id'])) {
    $transaction_id = $_GET['id'];

    // Fetch the record to be archived
    $sql_fetch_record = "SELECT * FROM transactions WHERE transaction_id = $transaction_id";
    $result_fetch_record = $conn->query($sql_fetch_record);

    if ($result_fetch_record->num_rows > 0) {
        // Fetch the record data
        $row = $result_fetch_record->fetch_assoc();

        // Insert the fetched record into the archive table
       $sql_insert_into_archive = "INSERT INTO archive (transaction_id,tracking_code, sender_id,branch_from,receiver_id, branch_to, amount, status, purpose, s_firstname,s_lastname,s_middlename,s_contact,s_address,r_firstname, r_lastname, r_middlename, r_contact, r_address,created_at) VALUES ('{$row['transaction_id']}', '{$row['tracking_code']}', '{$row['sender_id']}','{$row['branch_from']}','{$row['receiver_id']}','{$row['branch_to']}', '{$row['amount']}','{$row['status']}','{$row['purpose']}','{$row['s_firstname']}','{$row['s_lastname']}','{$row['s_middlename']}','{$row['s_contact']}', '{$row['s_address']}','{$row['r_firstname']}','{$row['r_lastname']}', '{$row['r_middlename']}','{$row['r_contact']}','{$row['r_address']}','{$row['created_at']}')";

        
        if ($conn->query($sql_insert_into_archive) === TRUE) {

            // Now, delete the record from the original table
            $sql_delete_record = "DELETE FROM transactions WHERE transaction_id = $transaction_id";

            if ($conn->query($sql_delete_record) === TRUE) {
               
                header('Location:list.php');
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error archiving record: " . $conn->error;
        }
    } else {
        echo "No record found to archive.";
    }
}

// Close the database connection
$conn->close();
?>


