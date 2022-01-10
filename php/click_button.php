<?php
    session_start();
    if ($_SESSION['filter']) {
        $_SESSION['filter'] = 0;
    } else {
        $_SESSION['filter'] = 1;
    }
    header('Location: valuebets.php');
