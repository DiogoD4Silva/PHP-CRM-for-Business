<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

require_once BASE_PATH . '/lib/Users/Users.php';
$users = new Users();

// Only super admin is allowed to access this page
if ($_SESSION['admin_type'] !== 'admin') {

    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit('Não Autorizado');
}

$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
$del_id = filter_input(INPUT_GET, 'del_id');

$pagelimit = 20;

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
$select = array('id', 'user_name', 'admin_type');


if ($search_string) {
    $db->where('user_name', '%' . $search_string . '%', 'like');
}

if ($order_by) {
    $db->orderBy($filter_col, $order_by);
}

$db->pageLimit = $pagelimit;

$rows = $db->arraybuilder()->paginate('admin_accounts', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Funcionários</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_admin.php" class="btn btn-success">Adicionar novo funcionário <i class="glyphicon glyphicon-plus"></i></a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>

    <?php
    if (isset($del_stat) && $del_stat == 1) {
        echo '<div class="alert alert-info">Apagado com sucesso</div>';
    }
    ?>

    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Procurar</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo htmlspecialchars($search_string, ENT_QUOTES, 'UTF-8'); ?>">
            <label for="input_order">Organizar por:</label>
            <select name="filter_col" class="form-control">
                <?php
                foreach ($users->setOrderingValues() as $opt_value => $opt_name) : ($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
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

    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="45%">Nome</th>
                <th width="40%">Nível</th>
                <th width="12%">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['admin_type']); ?></td>
                    <td>
                        <a href="edit_admin.php?admin_user_id=<?php echo $row['id']; ?>&operation=edit" alt="Editar" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="#" alt="Apagar" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>

                <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                    <div class="modal-dialog">
                        <form action="delete_user.php" method="POST">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirmação</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                    <p>Tem a certeza que quer apagar este funcionário?</p>
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
        <?php
        if (!empty($_GET)) {

            unset($_GET['page']);

            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = '';
                echo '<li' . $li_class . '><a href="admin_users.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
        }
        ?>
    </div>

</div>

<?php include BASE_PATH . '/includes/footer.php'; ?>