<?php
require_once 'classes/proveedor.php';
$params = $request->getParams();
if(!isset($params['nombre']) || !isset($params['telefono']) || !isset($params['email']) || !isset($params['web']) || !isset($params['extra']) || empty($params['nombre'])|| empty($params['telefono'])){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Proveedor();
if($obj->setId((int) $request->getAttribute('id'))){
  $obj->setNombre($params['nombre']);
  $obj->setTelefono($params['telefono']);
  $obj->setEmail($params['email']);
  $obj->setWeb($params['web']);
  $obj->setExtra($params['extra']);
  $response->write(json_encode($obj->Actualizar()));
}
else{
  $response->write(json_encode(false));
}

return $response;

?>
