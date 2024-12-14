

<?php
include('connect.php');

$id = $_GET["id"];
$sql = "DELETE FROM users WHERE user_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
   echo "<script>alert('deleted successfully')</script>";
  header("Location: user.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>


<?php
include('connect.php');

if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    
    $sql = "DELETE FROM fee_structure WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Deleted successfully')</script>";
        header("Location: fee.php?msg=Data deleted successfully");
        exit(); // Important to prevent further execution after redirection
    } else {
        echo "Failed: " . mysqli_error($conn);
    }


    mysqli_stmt_close($stmt);
} else {

    echo "Invalid ID parameter";
}
?>




