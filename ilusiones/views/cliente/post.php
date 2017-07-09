<?php
require_once 'classes/cliente.php';
$params = json_decode(file_get_contents('php://input'), true);
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['extra']) ||!isset($params['activo']) || empty($params['nombre'])|| empty($params['telefono'])){
  $response->write(json_encode(false));
  return $response;
}
$cliente = new Cliente();
$cliente->setNombre($params['nombre']);
$cliente->setTelefono($params['telefono']);
$cliente->setExtra($params['extra']);
$cliente->setActivo($params['activo']);
$response->write(json_encode($cliente->Save()));
return $response;
?>
