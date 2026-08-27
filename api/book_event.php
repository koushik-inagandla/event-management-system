<?php
session_start();
require_once __DIR__ . '/db.php';

if(!isset($_SESSION['customer_id'])){
    echo "not_logged_in";
    exit;
}

$customerId = $_SESSION['customer_id'];

$eventId = $_POST['eventId'] ?? 0;
$seats   = $_POST['seats'] ?? "";


$sql = "INSERT INTO Bookings (EventId, CustomerId, Seats) VALUES (?, ?, ?)";
$stmt = sqlsrv_query($conn, $sql, [$eventId, $customerId, $seats]);

if($stmt){
    echo "success";
} else {
    echo "error";
}
?>
