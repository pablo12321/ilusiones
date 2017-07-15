<?php
require_once 'classes/movimiento.php';
$params = $request->getParams();
if(!isset($params['tipo']) || !isset($params['uid']) || !isset($params['total']) || !isset($params['entregado']) ||!isset($params['detalle']) || !isset($params['creado']) || empty($params['uid'])){
  $response->write(json_encode(false));
  return $response;
}
if(empty($params['creado'])){
  date_default_timezone_set('America/Argentina/Cordoba');
  $params['creado'] = date("Y-m-d H:i:s");
}
$obj = new Movimiento();
$obj->setTipo($params['tipo']);
$obj->setUid($params['uid']);
$obj->setTotal($params['total']);
$obj->setEntregado($params['entregado']);
$obj->setDetalle($params['detalle']);
$obj->setCreado($params['creado']);
$response->write(json_encode($obj->Save()));
return $response;
?>
