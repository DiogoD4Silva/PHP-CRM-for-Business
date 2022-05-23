<!DOCTYPE html>
<html lang="PT-pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    
    <title>CRM</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="./css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- MetisMenu CSS -->
    <link href="assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- graph js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    <!-- apagar erros -->
    <?php error_reporting(0); ?>

</head>

<body>
    <div id="wrapper">

        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) : ?>
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Navegação</span>
                    </button>

                    <img src="includes/icon.png" class="navbar-brand">
                    
                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="view_admin.php?admin_user_id=<?php echo $_SESSION['id']; ?>"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>

                            <li><a href="chat.php">
                                    <!-- icon link--><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                    </svg><i class="bi bi-chat"></i> Chat
                                </a>
                            </li>

                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>

                    </li>

                </ul>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>

                            <li <?php echo (CURRENT_PAGE == "customers.php" || CURRENT_PAGE == "add_customer.php") ? 'class="active"' : ''; ?>>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Clientes<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="customers.php"><i class="fa fa-list fa-fw"></i>Lista</a>
                                    </li>
                                    <li>
                                        <a href="add_customer.php"><i class="fa fa-plus fa-fw"></i>Adicionar novo</a>
                                    </li>
                                </ul>
                            </li>

                            <li <?php echo (CURRENT_PAGE == "sales.php" || CURRENT_PAGE == "add_sales.php") ? 'class="active"' : ''; ?>>
                                <a href="#"><i class="fa fa-tasks fa-fw"></i> Projetos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="sales.php"><i class="fa fa-list fa-fw"></i>Lista</a>
                                    </li>
                                    <li>
                                        <a href="add_sales.php"><i class="fa fa-plus fa-fw"></i>Adicionar novo</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="admin_users.php"><i class="fa fa-user-circle fa-fw"></i> Funcionários</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </nav>
        <?php endif; ?>

    </div>