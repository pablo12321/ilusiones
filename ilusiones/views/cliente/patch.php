<?php
require_once 'classes/cliente.php';
$params = $request->getParams();
$cliente = new Cliente();
if($cliente->setId((int) $request->getAttribute('id'))){
  if(isset($params['nombre'])) $cliente->setNombre($params['nombre']);
  if(isset($params['telefono'])) $cliente->setTelefono($params['telefono']);
  if(isset($params['extra'])) $cliente->setExtra($params['extra']);
  if(isset($params['activo'])) $cliente->setActivo($params['activo']);
  $response->write(json_encode($params));
}
else{
  $response->write(json_encode(false));
}
return $response;
?>
