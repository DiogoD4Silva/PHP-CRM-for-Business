<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$sales_id = filter_input(INPUT_GET, 'sales_id', FILTER_VALIDATE_INT);

$sales_id = filter_input(INPUT_GET, 'sales_id', FILTER_SANITIZE_STRING);

$db = getDbInstance();
$db->where('id', $sales_id);


$sales = $db->getOne("sales");
$numSales = $db->getValue("sales", "count(*)");

include_once 'includes/header.php';
?>

<div id="page-wrapper">
        <div class="row">
                <div class="col-lg-6">
                        <h1 class="page-header">Informação do projeto </h1>
                </div>
                <div class="col-lg-6">
                        <div class="page-action-links text-right">
                                <?php
                                if ($sales['id'] > 1) {
                                        echo '<a href="view_sales.php?sales_id=' . $sales['id'] - 1 . '" class="btn btn-danger">Anterior <i class="glyphicon glyphicon-arrow-left"></i></a>';
                                }
                                echo '   ';
                                if ($sales['id'] < $numSales) {
                                        echo '<a href="view_sales.php?sales_id=' . $sales['id'] + 1 . '" class="btn btn-success">Seguinte <i class="glyphicon glyphicon-arrow-right"></i></a>';
                                }
                                ?>

                        </div>
                </div>
        </div>

        <?php
        include('./includes/flash_messages.php');
        ?>

        <div class="form-group">
                <label>Comprador</label>
                <label class="form-control"><?php echo $sales['buyer']; ?></label>
        </div>

        <div class="form-group">
                <label>Nome do projeto</label>
                <label class="form-control"><?php echo $sales['p_name']; ?></label>
        </div>

        <div class="form-group">
                <label>Descrição</label>
                <label class="form-control"><?php echo $sales['description']; ?></label>
        </div>

        <div class="form-group">
                <label>Serviços fornecidos</label>
                <label class="form-control"><?php echo $sales['type']; ?></label>
        </div>

        <div class="form-group">
                <label>Valor</label>
                <label class="form-control"><?php echo $sales['value']; ?> €</label>
        </div>

        <div class="form-group">
                <label>Estado</label>
                <label class="form-control"><?php echo $sales['status']; ?></label>
        </div>

        <div class="form-group">
                <label>Data de venda</label>
                <label class="form-control"><?php echo $sales['saled_at']; ?></label>
        </div>

        <div class="form-group">
                <label>Criado em</label>
                <label class="form-control"><?php echo $sales['created_at']; ?></label>
        </div>

        </form>
        <div class="form-group text-center">
                <a class="btn btn-danger" href="sales.php">Sair <span class="glyphicon glyphicon-remove"></span></a>
        </div>

</div>

<?php include_once 'includes/footer.php'; ?>