<?php
require_once 'classes/cliente.php';
$obj = new Cliente();
if(null !== $request->getAttribute('campo') && null !== $request->getAttribute('valor')){
  $response->write(json_encode($obj->getQuery($request->getAttribute('campo'),$request->getAttribute('valor'))));
}
else{
  $response->write(json_encode($obj->getAll()));
}
return $response;
?>
