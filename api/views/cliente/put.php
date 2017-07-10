<?php
require_once 'classes/cliente.php';
$params = $request->getParams();
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['extra']) || empty($params['nombre'])|| empty($params['telefono']){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Cliente();
if($obj->setId((int) $request->getAttribute('id'))){
  $obj->setNombre($params['nombre']);
  $obj->setTelefono($params['telefono']);
  $obj->setExtra($params['extra']);
  $response->write(json_encode($obj->Actualizar()));
}
else{
  $response->write(json_encode(false));
}

return $response;

?>
