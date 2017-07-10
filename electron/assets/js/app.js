var baseapi = "http://localhost/api";

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
    ruta:'/cliente/:id',
    url:'editar_cliente.html',
  },
  {
    enmenu:false,
    ruta:'/proveedor/:id',
    url:'editar_proveedor.html',
  }
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


app.controller('clientController', function($scope,$routeParams, $http) {
  $scope.obj = {};
  $scope.form = {};
  $scope.lista = {};
  $scope.clean = function (){
    $scope.message = "";
    $scope.state = "";
    $scope.form = {};
    $scope.form.extra = " ";
  };
  $scope.updateObj = function(id){
    $http({
      method: 'GET',
      url: baseapi+'/cliente/'+id
    }).then(function successCallback(response) {
      $scope.obj = response.data;
    });
  };
  $scope.getClient = function(id = $routeParams.id){
    $http({
      method: 'GET',
      url: baseapi+'/cliente/'+id
    }).then(function successCallback(response) {
      $scope.form = response.data;
    });
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
  $scope.eliminar = function(uid){
    if(confirm("¿Esta seguro que quiere eliminar el cliente?")){
      $http({
        method: 'DELETE',
        url: baseapi+'/cliente/'+uid
      }).then(function successCallback(response) {
        $scope.updateList();
      });
    }
  };
  $scope.submitForm = function() {
    $http({
      method  : 'POST',
      url     : baseapi+'/cliente',
      data: $scope.form,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (data){
      if (data.data) {
        $scope.clean();
        $scope.state = "success";
        $scope.message = "Cliente cargado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    });

  };
  $scope.updateClient = function(id = $routeParams.id) {
    $http({
      method  : 'PATCH',
      url     : baseapi+'/cliente/'+id,
      data: "nombre="+$scope.form.nombre+"&telefono="+$scope.form.telefono+"&extra="+$scope.form.extra,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (data){
      if (data.data) {
        $scope.state = "success";
        $scope.message = "Cliente actualizado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    });
  };
});

app.controller('providerController', function($scope,$routeParams,$rootScope, $http) {
  $scope.obj = {};
  $scope.form = {};
  $scope.lista = {};
  $scope.clean = function (){
    $scope.message = "";
    $scope.state = "";
    $scope.form = {};
    $scope.form.email = " ";
    $scope.form.web = " ";
    $scope.form.extra = " ";

  };
  $scope.updateObj = function(id){
    $http({
      method: 'GET',
      url: baseapi+'/proveedor/'+id
    }).then(function successCallback(response) {
      $scope.obj = response.data;
    });
  };
  $scope.getProvider = function(id = $routeParams.id){
    $http({
      method: 'GET',
      url: baseapi+'/proveedor/'+id
    }).then(function successCallback(response) {
      $scope.form = response.data;
    });
  };
  $scope.updateList = function (){
    $http({
      method: 'GET',
      url: baseapi+'/proveedor'
    }).then(function successCallback(response) {
      $scope.lista = response.data;
    }, function errorCallback(response) {
      $scope.lista = {};
    });
  };
  $scope.eliminar = function(uid){
    if(confirm("¿Esta seguro que quiere eliminar el proveedor?")){
      $http({
        method: 'DELETE',
        url: baseapi+'/proveedor/'+uid
      }).then(function successCallback(response) {
        $scope.updateList();
      });
    }
  };
  $scope.submitForm = function() {
    $http({
      method  : 'POST',
      url     : baseapi+'/proveedor',
      data: $scope.form,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (data){
      if (data.data) {
        $scope.clean();
        $scope.state = "success";
        $scope.message = "Proveedor cargado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    });

  };
  $scope.updateProvider = function(id = $routeParams.id) {
    $http({
      method  : 'PATCH',
      url     : baseapi+'/proveedor/'+id,
      data: "nombre="+$scope.form.nombre+"&telefono="+$scope.form.telefono+"&email="+$scope.form.email+"&web="+$scope.form.web+"&extra="+$scope.form.extra,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (data){
      if (data.data) {
        $scope.state = "success";
        $scope.message = "Proveedor actualizado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    });

  };
});
