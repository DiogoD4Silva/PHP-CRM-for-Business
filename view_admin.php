<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$admin_user_id = filter_input(INPUT_GET, 'admin_user_id');

$db = getDbInstance();
$db->where('id', $admin_user_id);

$admin = $db->getOne('admin_accounts');

include_once 'includes/header.php';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Informação do funcionário </h1>
        </div>
    </div>

    <?php
    include('./includes/flash_messages.php');
    ?>

    <div class="form-group">
        <label>Id</label>
        <label class="form-control"><?php echo $admin['id']; ?></label>
    </div>

    <div class="form-group">
        <label>Nome</label>
        <label class="form-control"><?php echo $admin['user_name']; ?></label>
    </div>

    <div class="form-group">
        <label>Nível</label>
        <label class="form-control"><?php echo $admin['admin_type']; ?></label>
    </div>

    </form>
    <div class="form-group text-center">
        <a class="btn btn-danger" onclick="javascript:history.go(-1)">Sair <span class="glyphicon glyphicon-remove"></span></a>
    </div>

</div>

<?php include_once 'includes/footer.php'; ?>