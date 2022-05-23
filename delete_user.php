<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
$db = getDbInstance();

if ($_SESSION['admin_type'] != 'admin') {
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
}

if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $db->where('id', $del_id);
    $stat = $db->delete('admin_accounts');
    if ($stat) {
        $_SESSION['info'] = "Apagado com sucesso!";
        header('location: admin_users.php');
        exit;
    }
}
