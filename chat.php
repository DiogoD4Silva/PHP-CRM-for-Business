<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<link id="css" rel="stylesheet" type="text/css" href="messaging/style.css">

<?php
include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">


        <div id="chatbox">
            <?php
            $chat = file_exists("messaging/log.html");
            if (file_exists("messaging/log.html") && filesize("messaging/log.html") > 0) {
                $handle = fopen("messaging/log.html", "r");
                $contents = fread($handle, filesize("messaging/log.html"));
                fclose($handle);
                echo $contents;
            }
            ?>
        </div>

        <form name="message" action="">
            <input name="usermsg" autofocus="" type="text" id="usermsg" size="63" />

            <button name="submitmsg" id="submitmsg" class="btn btn-warning">Enviar <span class="glyphicon glyphicon-send"></span></button>

            <?php if ($_SESSION['admin_type'] == 'admin') {

                echo '<button name="rezet" id="clearchat" class="btn btn-danger" value="rezet">Apagar Chat <span class="glyphicon glyphicon-remove"></span></button>';
            }
            ?>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    var scrollHeight = $("#chatbox").attr("scrollHeight") - 50;
                    var scroll = true;
                    if (scroll == true) {

                        $("#chatbox").animate({
                            scrollTop: scrollHeight
                        }, "normal");
                        load = false;
                    }
                });

                //delete the file content
                $(document).ready(function() {
                    $('#clearchat').click(function() {
                        var clickBtnValue = $(this).val();
                        var ajax = 'messaging/ajax.php',
                            data = {
                                'action': clickBtnValue
                            };
                        $.post(ajax, data, function(response) {});
                    });
                });

                //If user submits the form
                $("#submitmsg").click(function() {

                    var clientmsg = $("#usermsg").val();
                    $.post("messaging/post.php", {
                        text: clientmsg
                    });
                    $("#usermsg").attr("value", "");
                    loadLog;
                    return false;
                });

                function loadLog() {
                    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 50; //Scroll height before the request
                    $.ajax({
                        url: "messaging/log.html",
                        cache: false,
                        success: function(html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div

                            //Auto-scroll
                            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 50; //Scroll height after the request
                            if (newscrollHeight > oldscrollHeight) {
                                $("#chatbox").animate({
                                    scrollTop: newscrollHeight
                                }, "normal"); //Autoscroll to bottom of div
                            }
                        },
                    });
                }

                setInterval(loadLog, 2000);
            </script>

            <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>-->
        </form>

    </div>
</div>

<?php include_once('./includes/footer.php'); ?>