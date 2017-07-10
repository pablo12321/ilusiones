<?php
require_once 'classes/movimiento.php';
$obj = new Movimiento();
$response->write(json_encode($obj->getAll()));
return $response;
?>
