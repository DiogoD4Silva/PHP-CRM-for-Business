<?php
session_start();

if (isset($_SESSION['username'])) {
    if ($_POST['text'] == "" && $_POST['text'] == " ") {
        #prevents user from sending a blank message
    } else {
        $text = $_POST['text'];
        $fp = fopen("log.html", 'a');
        fwrite($fp, "<div class='msgln'><span>[" . date("d-m-Y G:i") . "] <b><user>" . $_SESSION['username'] . "</user></b>: " . stripslashes(htmlspecialchars($text)) . "<br></span></div>");
        fclose($fp);
    }
}
