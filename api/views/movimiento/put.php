<?php
require_once 'classes/movimiento.php';
$params = $request->getParams();
if(!isset($params['tipo']) || !isset($params['uid']) || !isset($params['total']) || !isset($params['entregado']) ||!isset($params['detalle']) || !isset($params['creado']) || empty($params['tipo']) || empty($params['uid']) || empty($params['creado'])){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Cliente();
if($obj->setId((int) $request->getAttribute('id'))){
  $obj->setTipo($params['tipo']);
  $obj->setUid($params['uid']);
  $obj->setTotal($params['total']);
  $obj->setEntregado($params['entregado']);
  $obj->setDetalle($params['detalle']);
  $obj->setCreado($params['creado']);
  $response->write(json_encode($obj->Actualizar()));
}
else{
  $response->write(json_encode(false));
}
return $response;
?>
