<?php
    function adding_class($class_name)
    {
        require "./classes/$class_name.php";
    }
    spl_autoload_register('adding_class');

    if (isset($_GET['submit'])) {
        if ($_GET['result'] == "1" || $_GET['result'] == "0") {
            $return = $_GET['odd'] * $_GET['stake'] * intval($_GET['result']) -  $_GET['stake'];
        } else {
            $return = 0;
        } 
        $arr = array($_GET['bet_id'], $_GET['bet'], $_GET['odd'], $_GET['value'], $_GET['stake'], $_GET['result'], $return);
    }
    $update_db = new BetHistoryModify();
    $update_db->updateDb($arr);
    header('Location: bet_history.php');