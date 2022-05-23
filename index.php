<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'helpers/helpers.php';

$db = getDbInstance();

$numCustomers = $db->getValue("customers", "count(*)");
$numSales = $db->getValue("sales", "count(*)");
$numStaff = $db->getValue("admin_accounts", "count(*)");

include_once('includes/header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
            <?php
            // print_r ($_SESSION);
            $daytime = (date("H"));

            switch ($daytime) {
                case (date("H") < 13):
                    $daytime = "um bom dia de trabalho. ";
                    break;

                case (date("H") == 13):
                    $daytime = "um bom almoço. ";
                    break;

                case (date("H") > 13):
                    $daytime = "uma boa tarde de trabalho. ";
                    break;
            }

            echo ("<h1> Bem-vindo/a " . $_SESSION['username'] . ", tenha " . $daytime . "</h1>");
            ?>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCustomers; ?></div>
                            <div>Clientes</div>
                        </div>
                    </div>
                </div>
                <a href="customers.php">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numSales; ?></div>
                            <div>Projetos</div>
                        </div>
                    </div>
                </div>
                <a href="sales.php">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numStaff; ?></div>
                            <div>Funcionários</div>
                        </div>
                    </div>
                </div>
                <a href="admin_users.php">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Calendário</h1>
        </div>

        <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css">
        <script src="fullcalendar/lib/jquery.min.js"></script>
        <script src="fullcalendar/lib/moment.min.js"></script>
        <script src="fullcalendar/fullcalendar.min.js"></script>
        <link rel="stylesheet" href="assets/css/style.css">

        <div class="col-lg-8">

            <script>
                $(document).ready(function() {
                    var calendar = $('#calendar').fullCalendar({
                        editable: true,
                        events: "fetch_event.php",
                        displayEventTime: false,
                        eventRender: function(event, element, view) {
                            if (event.allDay === 'true') {
                                event.allDay = true;
                            } else {
                                event.allDay = false;
                            }
                        },
                        selectable: true,
                        selectHelper: true,
                        select: function(start, end, allDay) {
                            var title = prompt('Nome do evento ?');

                            if (title) {
                                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

                                $.ajax({
                                    url: 'add_event.php',
                                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                                    type: "POST",
                                    success: function(data) {
                                        displayMessage("Evento adicionado com sucesso");
                                    }
                                });
                                calendar.fullCalendar('renderEvent', {
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay
                                    },
                                    true
                                );
                            }
                            calendar.fullCalendar('unselect');
                        },

                        editable: true,
                        eventDrop: function(event, delta) {
                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                            $.ajax({
                                url: 'edit_event.php',
                                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                                type: "POST",
                                success: function(response) {
                                    displayMessage("Evento atualizado com sucesso");
                                }
                            });
                        },
                        eventClick: function(event) {

                            var deleteMsg = confirm("Deseja apagar o evento?");
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: "delete_event.php",
                                    data: "&id=" + event.id,
                                    success: function(response) {
                                        if (parseInt(response) > 0) {
                                            $('#calendar').fullCalendar('removeEvents', event.id);
                                            displayMessage("Evento apagado com sucesso");
                                        }
                                    }

                                });
                            }
                        }

                    });
                });

                function displayMessage(message) {

                    $(".response").html("<div class='alert alert-success'>" +
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a> " +
                        message + "</div>");

                    unset($_SESSION['success']);

                }
            </script>

            <div id='calendar'></div>
        </div>

        <div class="col-lg-4">

            <div class="response"></div>

            <p class="scroll">
                <?php

                $query = "SELECT * FROM calendar ORDER BY start DESC";
                $result = mysqli_query($conn, $query);

                foreach ($conn->query($query) as $event)  /* - */ {

                    if ($event['start'] == $event['end']) {
                        echo 'Evento : ' . "<b>" . $event['title'] . "</b>" . " no dia " . "<b>" .  $event['start'] . "</b>" . "<br>";
                    } else {
                        echo 'Evento : ' . "<b>" . $event['title'] . "</b>" . " começa em " . "<b>" .  $event['start'] . "</b>" . " e acaba " . "<b>" . $event['end'] . "</b>" . "<br>";
                    }
                }
                ?>
            </p>

        </div>

    </div>

</div>

<script src="main.js"></script>
<?php include_once('includes/footer.php'); ?>