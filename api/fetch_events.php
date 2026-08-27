<?php
require_once __DIR__ . '/db.php';

$sql = "SELECT EventId, Title, Description, Location, StartDate, ImageUrl FROM Events ORDER BY StartDate ASC";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    header("Content-Type: application/json");
    echo json_encode([]);
    exit;
}

$out = [];
while ($row = sqlsrv_fetch_array($stmt)) {
    
    $dateStr = null;
    if ($row['StartDate'] instanceof DateTime) {
        $dateStr = $row['StartDate']->format("Y-m-d H:i:s");
    } else {
        $dateStr = $row['StartDate'];
    }
    $out[] = [
        "EventId" => $row['EventId'],
        "id" => $row['EventId'],
        "title" => $row['Title'],
        "description" => $row['Description'],
        "venue" => $row['Location'],
        "date"  => $dateStr,
        "image" => $row['ImageUrl']
    ];
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($out);
exit;
?>
