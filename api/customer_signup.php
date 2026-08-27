<?php
require_once __DIR__ . '/db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    echo "NULLError";
    exit;
}

$sql = "SELECT CustomerId, Password FROM Customers WHERE Username = ?";
$params = [$username];
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    echo "error1";
    exit;
}
$row = sqlsrv_fetch_array($stmt);
if ($row) {
    echo "exists";
    exit;
}



$insert = "INSERT INTO Customers (Username, Password) VALUES (?, ?)";
$ps = sqlsrv_query($conn, $insert, [$username, $password]);

if ($ps === false) {
    echo "error2";
    exit;
}

echo "success";
exit;
?>
