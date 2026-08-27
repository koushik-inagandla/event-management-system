<?php
session_start();
require_once __DIR__."/db.php";

if(!isset($_SESSION['customer_id'])){
    echo "not_logged_in";
    exit;
}

$customerId = $_SESSION['customer_id'];
$bookingId = intval($_GET['id']);

$sql = "DELETE FROM Bookings WHERE BookingId = ? AND CustomerId = ?";
$stmt = sqlsrv_query($conn, $sql, [$bookingId, $customerId]);

if($stmt){
    echo "success";
} else {
    echo "error";
}
?>
