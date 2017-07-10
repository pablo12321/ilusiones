<?php
require_once 'classes/cliente.php';
$obj = new Cliente();
$response->write(json_encode($obj->getAll()));
return $response;
?>
