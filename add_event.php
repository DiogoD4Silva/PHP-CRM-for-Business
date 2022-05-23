<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";

$sqlInsert = "INSERT INTO calendar (title,start,end) VALUES ('".$title."','".$start."','".$end."')";

$result = mysqli_query($conn, $sqlInsert);

if (! $result) {
    $result = mysqli_error($conn);
}
