<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'rezet':
            rezet();
            break;
    }
}

function rezet()
{
    fopen("log.html", "w+");
    exit;
}
