<?php
include('connect.php');

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare the DELETE statement
    $sql = "DELETE FROM branches WHERE branch_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            echo "<script>alert('Deleted successfully')</script>";
            header("Location: branch.php?msg=Data deleted successfully");
            exit(); // Prevent further execution after redirection
        } else {
            echo "Failed to execute the statement: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error in preparing the statement: " . mysqli_error($conn);
    }
} else {
    echo "Invalid ID parameter";
}
?>