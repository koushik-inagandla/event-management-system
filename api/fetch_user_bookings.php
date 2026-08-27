<?php
session_start();
require_once __DIR__ . '/db.php';

if(!isset($_SESSION['customer_id'])){
    echo json_encode([]);
    exit;
}

$customerId = $_SESSION['customer_id'];

$sql = "
SELECT 
    B.BookingId,
    E.EventId,
    E.Title,
    E.Location,
    E.StartDate,
    E.ImageUrl
FROM Bookings B
JOIN Events E ON B.EventId = E.EventId
WHERE B.CustomerId = ?
ORDER BY B.BookingId DESC
";

$stmt = sqlsrv_query($conn, $sql, [$customerId]);

$out = [];
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

    if ($row['StartDate'] instanceof DateTime) {
        $date = $row['StartDate']->format("Y-m-d H:i:s");
    } else {
        $date = $row['StartDate'];
    }

    
    $out[] = [
        "bookingId" => $row['BookingId'],
        "eventId" => $row['EventId'],
        "title" => $row['Title'],
        "venue" => $row['Location'],
        "date" => $date,
        "image" => $row['ImageUrl']
    ];
}

echo json_encode($out);
exit;
?>
