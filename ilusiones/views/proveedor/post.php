<?php
require_once 'classes/proveedor.php';
$params = json_decode(file_get_contents('php://input'), true);
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['email']) || !isset($params['web']) || !isset($params['extra']) || empty($params['nombre'])|| empty($params['telefono'])){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Proveedor();
$obj->setNombre($params['nombre']);
$obj->setTelefono($params['telefono']);
$obj->setEmail($params['email']);
$obj->setWeb($params['web']);
$obj->setExtra($params['extra']);
$response->write(json_encode($obj->Save()));
return $response;
?>
