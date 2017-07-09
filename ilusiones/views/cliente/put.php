<?php
require_once 'classes/cliente.php';
$params = $request->getParams();
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['extra'])||!isset($params['activo'])){
  $response->write(json_encode(false));
  return $response;
}
$cliente = new Cliente();
if($cliente->setId((int) $request->getAttribute('id'))){
  $cliente->setNombre($_REQUEST['nombre']);
  $cliente->setTelefono($_REQUEST['telefono']);
  $cliente->setExtra($_REQUEST['extra']);
  $cliente->setActivo($params['activo']);
  $response->write(json_encode($cliente->Actualizar()));
}
else{
  $response->write(json_encode(false));
}

return $response;

?>
