<?php
require_once 'classes/cliente.php';
$obj = new Cliente();
if($obj->setId((int) $request->getAttribute('id')))
  $response->write(json_encode($obj->Eliminar()));
else
  $response->write(json_encode(false));
return $response;
?>
