<?php
require_once __DIR__ . '/db.php';

$title = trim($_POST['title'] ?? '');
$venue = trim($_POST['venue'] ?? '');
$date = trim($_POST['date'] ?? '');
$image = trim($_POST['image'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($title === '' || $venue === '' || $date === '') {
    echo "error";
    exit;
}

$insert = "INSERT INTO Events (Title, Description, Location, StartDate, ImageUrl) VALUES (?, ?, ?, ?, ?)";
$params = [$title, $description, $venue, $date, $image];
$stmt = sqlsrv_query($conn, $insert, $params);

if ($stmt === false) {
    echo "error";
    exit;
}

echo "success";
exit;
?>
