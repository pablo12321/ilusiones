<?php
require_once 'classes/cliente.php';
$params = json_decode(file_get_contents('php://input'), true);
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['extra']) || empty($params['nombre'])|| empty($params['telefono'])){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Cliente();
$obj->setNombre($params['nombre']);
$obj->setTelefono($params['telefono']);
$obj->setExtra($params['extra']);
$response->write(json_encode($obj->Save()));
return $response;
?>
