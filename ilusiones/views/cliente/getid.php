<?php
header('Content-Type: application/json');
require_once 'classes/cliente.php';
$cliente = new Cliente();
if($cliente->setId((int) $request->getAttribute('id')))
  $response->write(json_encode($cliente->getArray()));
else
  $response->write(json_encode(false));
return $response;
?>
