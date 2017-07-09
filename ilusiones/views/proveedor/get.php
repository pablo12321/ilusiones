<?php
require_once 'classes/proveedor.php';
$obj = new Proveedor();
$response->write(json_encode($obj->getAll()));
return $response;
?>
