<?php 
session_start();

require_once('database.php');
function autoloadPHP_Inc($class){
    require_once('php_inc/' . $class . '.inc.php');
}
spl_autoload_register('autoloadPHP_Inc');
?>
