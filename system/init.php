<?php
spl_autoload_register(function($className){
    $class_name = lcfirst($className);
    include "classes/$class_name.php";
});

$route = new route();

?>