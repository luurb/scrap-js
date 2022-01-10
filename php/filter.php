<?php
    function adding_class($class_name)
    {
        require "./classes/$class_name.php";
    }
    spl_autoload_register('adding_class');
    $filter = new Filter();
    $filter->filter();
    header('Location: valuebets.php');