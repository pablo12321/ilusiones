<?php
require_once 'classes/movimiento.php';
$obj = new Movimiento();
if($obj->setId((int) $request->getAttribute('id')))
  $response->write(json_encode($obj->getArray()));
else
  $response->write(json_encode(false));
return $response;
?>
