<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once 'classes/mysql.php';

$app = new \Slim\App;

$rutas = array(
  'get' => array(
    '/cliente' => 'views/cliente/get.php',
    '/cliente/{id}' => 'views/cliente/getid.php',
    '/producto' => 'views/producto/get.php',
    '/producto/{id}' => 'views/producto/getid.php',
    '/proveedor' => 'views/proveedor/get.php',
    '/proveedor/{id}' => 'views/proveedor/getid.php',
    '/movimiento' => 'views/movimiento/get.php',
    '/movimiento/{id}' => 'views/movimiento/getid.php'
    ),
  'post' => array(
    '/cliente' => 'views/cliente/post.php',
    '/producto' => 'views/producto/post.php',
    '/proveedor' => 'views/proveedor/post.php',
    '/movimiento' => 'views/movimiento/post.php'
    ),
  'put' => array(
    '/cliente/{id}' => 'views/cliente/put.php',
    '/producto/{id}' => 'views/producto/put.php',
    '/proveedor/{id}' => 'views/proveedor/put.php',
    '/movimiento/{id}' => 'views/movimiento/put.php'
    ),
  'delete' => array(
    '/cliente/{id}' => 'views/cliente/delete.php',
    '/producto/{id}' => 'views/producto/delete.php',
    '/proveedor/{id}' => 'views/proveedor/delete.php',
    '/movimiento/{id}' => 'views/movimiento/delete.php'
    ),
  'patch' => array(
    '/cliente/{id}' => 'views/cliente/patch.php',
    '/producto/{id}' => 'views/producto/patch.php',
    '/proveedor/{id}' => 'views/proveedor/patch.php',
    '/movimiento/{id}' => 'views/movimiento/patch.php'
    )
);


foreach ($rutas['get'] as $ruta => $archivo) {
  $app->get($ruta, function (Request $request, Response $response) use ($archivo) {
      include($archivo);

  });
}

foreach ($rutas['post'] as $ruta => $archivo) {
  $app->post($ruta, function (Request $request, Response $response) use ($archivo) {
      include($archivo);
  });
}

foreach ($rutas['put'] as $ruta => $archivo) {
  $app->put($ruta, function (Request $request, Response $response) use ($archivo) {
      include($archivo);
  });
}

foreach ($rutas['delete'] as $ruta => $archivo) {
  $app->delete($ruta, function (Request $request, Response $response) use ($archivo) {
      include($archivo);
  });
}

foreach ($rutas['patch'] as $ruta => $archivo) {
  $app->patch($ruta, function (Request $request, Response $response) use ($archivo) {
      include($archivo);
  });
}
$app->run();
header('Content-Type: application/json');
