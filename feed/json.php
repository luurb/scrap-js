<?php

function adding_class($class_name) {
    require "./classes/$class_name.php";
}
spl_autoload_register('adding_class');

$json = new CreateJSON();
echo $json->returnJSON();