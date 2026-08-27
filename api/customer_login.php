<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT CustomerId, Password FROM Customers WHERE Username=?";
$stmt = sqlsrv_query($conn, $sql, array($username));

if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

    
    if (password_verify($password, $row['Password'])) {

        $_SESSION['customer_id'] = $row['CustomerId'];
        $_SESSION['username'] = $username;
        echo "success";
        exit;
    }

    
    if ($password === $row['Password']) {

        $_SESSION['customer_id'] = $row['CustomerId'];
        $_SESSION['username'] = $username;
        echo "success";
        exit;
    }
}

echo "invalid";
?>
