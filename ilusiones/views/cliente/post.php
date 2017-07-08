<?php
require_once 'classes/cliente.php';
$params = $request->getParams();
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['extra'])){
  $response->write(json_encode(false));
  return $response;
}
$cliente = new Cliente();
$cliente->setNombre($_REQUEST['nombre']);
$cliente->setTelefono($_REQUEST['telefono']);
$cliente->setExtra($_REQUEST['extra']);
$response->write(json_encode($cliente->Save()));
return $response;
?>
