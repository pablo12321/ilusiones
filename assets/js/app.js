var baseapi = "http://localhost/ilusiones";

var pagesF = "pages/";
var menu = [
  {
    enmenu:true,
    nombre:'Resumen',
    ruta:'/',
    url:'resumen.html',
    ico:'dashboard',
  },
  {
    enmenu:true,
    nombre:'Productos',
    ruta:'/productos',
    url:'productos.html',
    ico:'trophy',
  },
  {
    enmenu:true,
    nombre:'Proveedores',
    ruta:'/proveedores',
    url:'proveedores.html',
    ico:'id-card',
  },
  {
    enmenu:true,
    nombre:'Clientes',
    ruta:'/clientes',
    url:'clientes.html',
    ico:'users',
  },
  {
    enmenu:false,
    nombre:'Nuevo Cliente',
    ruta:'/nuevo_clientes',
    url:'nuevo_clientes.html',
    ico:'users',
  },
  {
    enmenu:true,
    nombre:'Ingreso',
    ruta:'/ingreso',
    url:'ingreso.html',
    ico:'plus',
  },
  {
    enmenu:true,
    nombre:'Egreso',
    ruta:'/egreso',
    url:'egreso.html',
    ico:'minus',
  },
  {
    enmenu:true,
    nombre:'Movimientos',
    ruta:'/movimientos',
    url:'movimientos.html',
    ico:'list',
  },
  {
    enmenu:true,
    nombre:'Caja',
    ruta:'/caja',
    url:'caja.html',
    ico:'cart-arrow-down',
  },
  {
    enmenu:false,
    nombre:'Clientes',
    ruta:'/clientes/:id',
    url:'cliente_id.html',
    ico:'users',
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


app.controller('clientController', function($scope,$route, $http) {
        $scope.cliente = {};
        $scope.cliente.extra = "";
        $scope.lista = {};
        $scope.clean = function (){
          $scope.message = "";
          $scope.state ="";
        };
        $scope.updateList = function (){
          $http({
            method: 'GET',
            url: baseapi+'/cliente'
          }).then(function successCallback(response) {
            $scope.lista = response.data;
          }, function errorCallback(response) {
            $scope.lista = {};
          });
        };
        $scope.submitForm = function() {
        $http({
          method  : 'POST',
          url     : baseapi+'/cliente',
          data: $scope.cliente,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (data){
          if (data.data) {
           $scope.state = "success";
           $scope.message = "Cliente cargado correctamente.";
          } else {
           $scope.state = "error";
           $scope.message = "Verifique que los datos sean correctos.";
          }
        });
        location.reload();
        };
    });
