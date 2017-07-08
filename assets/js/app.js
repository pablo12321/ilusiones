var baseapi = "http://localhost/ilusiones";

var pagesF = "pages/";
var menu = [
  {
    nombre:'Resumen',
    ruta:'/',
    url:'resumen.html',
    ico:'dashboard',
  },
  {
    nombre:'Productos',
    ruta:'/productos',
    url:'productos.html',
    ico:'trophy',
  },
  {
    nombre:'Proveedores',
    ruta:'/proveedores',
    url:'proveedores.html',
    ico:'id-card',
  },
  {
    nombre:'Clientes',
    ruta:'/clientes',
    url:'clientes.html',
    ico:'users',
  },
  {
    nombre:'Ingreso',
    ruta:'/ingreso',
    url:'ingreso.html',
    ico:'plus',
  },
  {
    nombre:'Egreso',
    ruta:'/egreso',
    url:'egreso.html',
    ico:'minus',
  },
  {
    nombre:'Movimientos',
    ruta:'/movimientos',
    url:'movimientos.html',
    ico:'list',
  },
  {
    nombre:'Caja',
    ruta:'/caja',
    url:'caja.html',
    ico:'cart-arrow-down',
  },
]

var app = angular.module("myApp",["ngRoute"]);

app.config(function($routeProvider) {
    menu.forEach(function(page) {
    $routeProvider.when(page.ruta, {
      templateUrl : pagesF+page.url
    })
    });
});

app.controller('MenuController', function($scope) {
    $scope.items = menu;
});


app.controller('clientController', function($scope, $http) {
        $scope.cliente = {};
        $scope.submitForm = function() {
        $http({
          method  : 'POST',
          url     : baseapi+'/cliente',
          data    : $scope.cliente,
          headers: {
            'Content-Type': "Content-Type: application/json"
          }
        }).then(function (data){
          $scope.message = data;
           if (data.data) {
             $scope.state = "success";
             $scope.message = "Cliente cargado correctamente.";
           } else {
             $scope.state = "error";
             $scope.message = "Verifique que los datos sean correctos.";
           }
           $scope.message = data;
         });

        };
    });
