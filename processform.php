<?php
include 'connection/connection.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    die;
    
}
// Assuming you have already established a database connection

// Retrieve the submitted medication data
$medications = explode("\n", $_POST['medications']); // Split textarea input into an array
$quantities = explode("\n", $_POST['quantities']); // Split textarea input into an array

$count = min(count($medications), count($quantities)); // Take the minimum count to ensure both arrays have the same length

for ($i = 0; $i < $count; $i++) {
  $medication = trim($medications[$i]); // Trim leading/trailing whitespace
  $quantity = trim($quantities[$i]); // Trim leading/trailing whitespace

  if (!empty($medication) && !empty($quantity)) {
    // Update the medicine table in the database
    $query = "UPDATE medicine SET quantity = quantity - $quantity WHERE medication_name = '$medication'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      echo "Deducted $quantity of medication '{$medication}' successfully.<br>";
    } else {
      echo "Error deducting $quantity of medication '{$medication}': " . mysqli_error($connection) . "<br>";
    }
  }
}

// Close the database connection
mysqli_close($connection);
?>
