<?php
    function adding_class($class_name)
    {
        require "./classes/$class_name.php";
    }
    spl_autoload_register('adding_class');
    if (isset($_GET['del'])) {
        $delete = new BetHistoryModify();
        $delete->delete($_GET['del']);
    }
    header('Location: bet_history.php');
