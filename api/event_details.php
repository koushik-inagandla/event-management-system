<?php

require_once __DIR__ . '/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["error" => "Invalid id"]);
    exit;
}

$sql = "SELECT EventId, Title, Description, Location, StartDate, ImageUrl FROM Events WHERE EventId = ?";
$stmt = sqlsrv_query($conn, $sql, [$id]);
if ($stmt === false) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "DB error"]);
    exit;
}
$row = sqlsrv_fetch_array($stmt);
if (!$row) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(["error" => "Event not found"]);
    exit;
}

$dateStr = null;
if ($row['StartDate'] instanceof DateTime) {
    $dateStr = $row['StartDate']->format("Y-m-d H:i:s");
} else {
    $dateStr = $row['StartDate'];
}

$out = [
    "EventId" => $row['EventId'],
    "title" => $row['Title'],
    "description" => $row['Description'],
    "venue" => $row['Location'],
    "date" => $dateStr,
    "image" => $row['ImageUrl']
];

header("Content-Type: application/json; charset=utf-8");
echo json_encode($out);
exit;
?>
