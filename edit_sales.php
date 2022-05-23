<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$sales_id = filter_input(INPUT_GET, 'sales_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;
$db = getDbInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sales_id = filter_input(INPUT_GET, 'sales_id', FILTER_SANITIZE_STRING);

    $data_to_update = filter_input_array(INPUT_POST);

    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('id', $sales_id);
    $stat = $db->update('sales', $data_to_update);

    if ($stat) {
        $_SESSION['success'] = "Venda atualizada!";

        header('location: sales.php');

        exit();
    }
}

if ($edit) {
    $db->where('id', $sales_id);

    $sales = $db->getOne("sales");
}

include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Editar venda</h2>
    </div>

    <?php
    include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">

        <?php
        require_once('./forms/sales_form.php');
        ?>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>