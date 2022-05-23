<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';

$id = filter_input(INPUT_POST, 'id');
$id = $_POST['id'];
$sqlDelete = "DELETE from calendar WHERE id=".$id;

if($_SESSION['admin_type']!='admin'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("Não autorizado");
}

mysqli_query($conn, $sqlDelete);
echo mysqli_affected_rows($conn);

mysqli_close($conn);
