<?php
require_once 'classes/cliente.php';
$params = $request->getParams();
$cliente = new Cliente();
if($cliente->setId((int) $request->getAttribute('id'))){
  if(isset($params['nombre'])) $cliente->setNombre($_REQUEST['nombre']);
  if(isset($params['telefono'])) $cliente->setTelefono($_REQUEST['telefono']);
  if(isset($params['extra'])) $cliente->setExtra($_REQUEST['extra']);
  $response->write(json_encode($cliente->Actualizar()));
}
else{
  $response->write(json_encode(false));
}
return $response;
?>
