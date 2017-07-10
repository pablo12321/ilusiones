<?php
require_once 'classes/proveedor.php';
$params = $request->getParams();
if((isset($params['nombre'])  && empty($params['nombre'])) || (isset($params['telefono'])  && empty($params['telefono']))){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Proveedor();
if($obj->setId((int) $request->getAttribute('id'))){
  if(isset($params['nombre'])) $obj->setNombre($params['nombre']);
  if(isset($params['telefono'])) $obj->setTelefono($params['telefono']);
  if(isset($params['email'])) $obj->setEmail($params['email']);
  if(isset($params['web'])) $obj->setWeb($params['web']);
  if(isset($params['extra'])) $obj->setExtra($params['extra']);
  $response->write(json_encode($obj->Actualizar()));
}
else{
  $response->write(json_encode(false));
}
return $response;
?>
