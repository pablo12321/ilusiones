<?php
header('Content-Type: application/json');
require_once 'classes/proveedor.php';
$obj = new Proveedor();
if($obj->setId((int) $request->getAttribute('id')))
  $response->write(json_encode($obj->getArray()));
else
  $response->write(json_encode(false));
return $response;
?>
