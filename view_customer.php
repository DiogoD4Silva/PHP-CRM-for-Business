<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);

$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_SANITIZE_STRING);

$db = getDbInstance();
$db->where('id', $customer_id);

$customer = $db->getOne("customers");
$numCustomers = $db->getValue("customers", "count(*)");

include_once 'includes/header.php';
?>

<div id="page-wrapper">
        <div class="row">
                <div class="col-lg-6">
                        <h1 class="page-header">Informação do cliente </h1>
                </div>
                <div class="col-lg-6">
                        <div class="page-action-links text-right">
                                <?php
                                if ($customer['id'] > 1) {
                                        echo '<a href="view_customer.php?customer_id=' . $customer['id'] - 1 . '" class="btn btn-danger">Anterior <i class="glyphicon glyphicon-arrow-left"></i></a>';
                                }
                                echo '   ';
                                if ($customer['id'] < $numCustomers) {
                                        echo '<a href="view_customer.php?customer_id=' . $customer['id'] + 1 . '" class="btn btn-success">Seguinte <i class="glyphicon glyphicon-arrow-right"></i></a>';
                                }
                                ?>

                        </div>
                </div>
        </div>

        <?php
        include('./includes/flash_messages.php');
        ?>

        <div class="form-group">
                <label>Empresa</label>
                <label class="form-control"><?php echo $customer['company']; ?></label>
        </div>

        <div class="form-group">
                <label>Nome do responsável</label>
                <label class="form-control"><?php echo $customer['emp']; ?></label>
        </div>

        <div class="form-group">
                <label>Serviços fornecidos</label>
                <label class="form-control">
                        <?php
                        $query = "SELECT DISTINCT type FROM sales WHERE buyer= '" . $customer['company'] . "'";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($result)) :;
                                if ($row['type'] = $row['type']) {
                                        echo $row['type'] . '; ';
                                }
                        endwhile;
                        ?>
                </label>
        </div>

        <div class="form-group">
                <label>Morada</label>
                <label class="form-control"><?php echo $customer['address']; ?></label>
        </div>

        <div class="form-group">
                <label>Cidade</label>
                <label class="form-control"><?php echo $customer['city']; ?></label>
        </div>

        <div class="form-group">
                <label>Telefone</label>
                <label class="form-control"><?php echo $customer['phone']; ?></label>
        </div>

        <div class="form-group">
                <label>E-mail</label>
                <label class="form-control"><?php echo $customer['email']; ?></label>
        </div>

        <div class="form-group">
                <label>Criado em</label>
                <label class="form-control"><?php echo $customer['created_at']; ?></label>
        </div>

        </form>
        <div class="form-group text-center">
                <a class="btn btn-danger" href="customers.php">Sair <span class="glyphicon glyphicon-remove"></span></a>
        </div>

</div>

<?php include_once 'includes/footer.php'; ?>