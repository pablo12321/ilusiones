<?php
require_once 'classes/cliente.php';
$cliente = new Cliente();
$response->write(json_encode($cliente->getAll()));
return $response;
?>
