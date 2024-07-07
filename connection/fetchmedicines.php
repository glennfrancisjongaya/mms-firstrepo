<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'connection/connection.php';

if (isset($_POST['medicinetype'])) {
    $selectedType = $_POST['medicinetype'];

    $query = "SELECT MedicineID, MedicineName FROM medicine WHERE MedicineType = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $selectedType);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $medicines = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    echo json_encode($medicines);
}
?>
