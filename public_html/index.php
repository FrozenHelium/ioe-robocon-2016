<?php

require_once '../classes/Router.php';

$router = new Router();
$router->route($_SERVER['PHP_SELF'], $_SERVER['REQUEST_URI']);

?>
