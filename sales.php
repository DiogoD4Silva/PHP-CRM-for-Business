<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

require_once BASE_PATH . '/lib/Sales/Sales.php';
$sales = new Sales();

$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

$pagelimit = 15;

$page = filter_input(INPUT_GET, 'page');
if (!$page) {
    $page = 1;
}

if (!$filter_col) {
    $filter_col = 'id';
}
if (!$order_by) {
    $order_by = 'Desc';
}

$db = getDbInstance();
$select = array('id', 'saled_at', 'p_name', 'created_at', 'type', 'updated_at', 'status', 'description', 'value', 'buyer');

if ($order_by) {
    $db->orderBy($filter_col, $order_by);
}

$db->pageLimit = $pagelimit;

if ($search_string) {
    $db->where('buyer', '%' . $search_string . '%', 'like');
}

$rows = $db->arraybuilder()->paginate('sales', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Projetos </h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_sales.php?operation=create" class="btn btn-success">Adicionar novo projeto <i class="glyphicon glyphicon-plus"></i></a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>

    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Procurar</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo xss_clean($search_string); ?>">
            <label for="input_order">Organizar por:</label>
            <select name="filter_col" class="form-control">
                <?php
                foreach ($sales->setOrderingValues() as $opt_value => $opt_name) : ($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
                    echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
                endforeach;
                ?>
            </select>
            <select name="order_by" class="form-control" id="input_order">
                <option value="Asc" <?php
                                    if ($order_by == 'Asc') {
                                        echo 'selected';
                                    }
                                    ?>>Ascendente</option>
                <option value="Desc" <?php
                                        if ($order_by == 'Desc') {
                                            echo 'selected';
                                        }
                                        ?>>Descendente</option>
            </select>
            <button type="submit" class="btn btn-primary">Pesquisar <i class="bi bi-search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </i></button>
        </form>
    </div>
    <hr>

    <div id="export-section">
        <a href="export_sales.php"><button class="btn btn-sm btn-primary">Exportar para CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>

    <?php
    $queryPT = $conn->query("
    SET lc_time_names = 'pt_PT';
");

    $query = $conn->query("
    
    SELECT 
      MONTHNAME(created_at) as monthname,
      #MONTHNAME(saled_at) as monthname,
      SUM(numSales) as amount
      
    FROM sales
    WHERE (created_at BETWEEN '" . (date("Y")) . "-01-01 00:00:01' AND '" . (date("Y") + 1) . "-01-01 00:00:01')
    #WHERE (saled_at BETWEEN '" . (date("Y")) . "-01-01 00:00:01' AND '" . (date("Y") + 1) . "-01-01 00:00:01')
    GROUP BY monthname
    ORDER BY STR_TO_DATE(CONCAT('monthname'), '%c');    
  ");

    foreach ($query as $data) {
        $month[] = $data['monthname'];
        $amount[] = $data['amount'];
    } ?>

    <style>
        .container {
            width: 1020px;
            height: 520px;
            display: inline-block;
        }

        @media screen and (max-width: 920px) {
            .container {
                width: 580px;
                height: 320px;
                float: left;
                display: flex;
                flex-flow: column;
            }

        }

        @media screen and (max-width: 420px) {
            .container {
                width: 380px;
                height: 220px;
                float: left;
                display: flex;
                flex-flow: column;
            }

        }
    </style>

    <div class="container">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const labels = <?php echo json_encode($month) ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Número de projetos registados por mês',
                data: <?php echo json_encode($amount) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="20%">Comprador</th>
                <th width="40%">Descrição</th>
                <th width="15%">Estado do projeto</th>
                <th width="14%">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo xss_clean($row['buyer']); ?></td>
                    <td><?php echo xss_clean($row['description']); ?></td>
                    <td><?php echo xss_clean($row['status']); ?></td>
                    <td>

                        <?php
                        $query = "SELECT * FROM customers WHERE company= '" . $row['buyer'] . "'";
                        $result = mysqli_query($conn, $query);

                        while ($row1 = mysqli_fetch_array($result)) :; ?>

                            <!-- <a href="mailto:<?php echo $row1['email'] ?>?subject=<?php echo xss_clean($row['type']) ?>" class="btn btn-success"><i class="fa fa-envelope"></i></a> -->

                        <?php endwhile; ?>

                        <a href="view_sales.php?sales_id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fa fa-tasks fa-fs"></i></a>

                        <a href="edit_sales.php?sales_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>

                        <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>

                <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                    <div class="modal-dialog">
                        <form action="delete_sales.php" method="POST">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirmação</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                    <p>Tem a certeza que quer apagar este projeto?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default pull-left">Sim</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <?php echo paginationLinks($page, $total_pages, 'sales.php'); ?>
    </div>

</div>

<?php include BASE_PATH . '/includes/footer.php'; ?>