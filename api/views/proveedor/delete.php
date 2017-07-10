<?php
require_once 'classes/proveedor.php';
$obj = new Proveedor();
if($obj->setId((int) $request->getAttribute('id')))
  $response->write(json_encode($obj->Eliminar()));
else
  $response->write(json_encode(false));
return $response;
?>
