<?php

ini_set('display_errors', 1);   
error_reporting(E_ALL);

$serverName =  "localhost\\SQLEXPRESS";

$connectionOptions = [
    "Database" => "eventdb"
    
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {

    die(json_encode([
        "error" => "Could not connect to database",
        "sqlsrv_errors" => sqlsrv_errors()
    ]));
}

function json_response($data) {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($data);
    exit;
}

?>
