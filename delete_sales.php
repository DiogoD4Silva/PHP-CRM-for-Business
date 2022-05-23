<?php
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_SESSION['admin_type'] != 'admin') {
        $_SESSION['failure'] = "Não tens permissão para efectuar esta acão";
        header('location: sales.php');
        exit;
    }
    $sales_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $sales_id);
    $status = $db->delete('sales');

    if ($status) {
        $_SESSION['info'] = "Projeto apagado com sucesso!";
        header('location: sales.php');
        exit;
    } else {
        $_SESSION['failure'] = "Falha ao apagar projeto!";
        header('location: sales.php');
        exit;
    }
}
