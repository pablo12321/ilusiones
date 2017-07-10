<?php
require_once 'classes/movimiento.php';
$params = $request->getParams();
if( (isset($params['tipo']) && empty($params['tipo'])) || (isset($params['uid'])  && empty($params['uid'])) || (isset($params['total'])  && empty($params['total'])) || (isset($params['entregado'])  && empty($params['entregado']))){
  $response->write(json_encode(false));
  return $response;
}
$obj = new Movimiento();
if($obj->setId((int) $request->getAttribute('id'))){
  if(isset($params['tipo'])) $obj->setTipo($params['tipo']);
  if(isset($params['uid'])) $obj->setUid($params['uid']);
  if(isset($params['total'])) $obj->setTotal($params['total']);
  if(isset($params['entregado'])) $obj->setEntregado($params['entregado']);
  if(isset($params['detalle'])) $obj->setDetalle($params['detalle']);
  if(isset($params['creado'])) $obj->setCreado($params['creado']);
  $response->write(json_encode($obj->Actualizar()));
}
else{
  $response->write(json_encode(false));
}
return $response;
?>
