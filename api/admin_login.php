<?php
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM Admins WHERE username=? AND password=?";
$stmt = sqlsrv_query($conn, $sql, array($username, $password));

if($row = sqlsrv_fetch_array($stmt)){
    echo "success";
} else {
    echo "invalid";
}
?>