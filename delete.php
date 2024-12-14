
<?php
include('connect.php');

$id = $_GET["id"];
$sql = "DELETE FROM archive WHERE transaction_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
   echo "<script>alert('deleted successfully')</script>";
  header("Location: archive1.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
