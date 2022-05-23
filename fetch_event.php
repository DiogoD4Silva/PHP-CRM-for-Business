<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';

$sqlQuery = "SELECT * FROM calendar ORDER BY id";

$result = mysqli_query($conn, $sqlQuery);
$eventArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push($eventArray, $row);
}

echo json_encode($eventArray);
