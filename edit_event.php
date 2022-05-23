<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

$sqlUpdate = "UPDATE calendar SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $id;
mysqli_query($conn, $sqlUpdate);

mysqli_close($conn);
