var baseapi = "http://localhost/api";
var test;
var pagesF = "pages/";
function apiError(){
  window.location.href = "#!/error";
  $('.modal-backdrop').hide();
}
var menu = [
  {
    nombre:'Inicio',
    ruta:'/',
    url:'inicio.html',
    ico:'home',
  },
  {
    nombre:'Resumen',
    ruta:'/resumen',
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
    inmenu:false,
    nombre:'Error',
    ruta:'/error',
    url:'error.html',
    ico:'list',
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
app.controller('ingegController', function($scope, $http) {
  $scope.lista = {};
  $scope.clean = function (){
    $scope.message = "";
    $scope.state = "";
    $scope.form = {};
    $scope.form.detalle = "";
  };
  $scope.updateList = function (ruta){
    $http({
      method: 'GET',
      url: baseapi+'/'+ruta
    }).then(function successCallback(response) {
      $scope.lista = response.data;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.submitForm = function(tipo) {
    $scope.form.tipo = tipo;
    $scope.form.creado = ""
    $http({
      method  : 'POST',
      url     : baseapi+'/movimiento',
      data: "tipo="+$scope.form.tipo+"&uid="+$scope.form.uid+"&total="+$scope.form.total+"&entregado="+$scope.form.entregado+"&detalle="+$scope.form.detalle+"&creado="+$scope.form.creado,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback(data){
      if (data.data) {
        $scope.clean();
        $scope.state = "success";
        if(tipo == '1'){
          $scope.message = "Ingreso registrado correctamente.";
        }
        else{
          $scope.message = "Egreso registrado correctamente.";
        }
      }
      else{
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    }, function errorCallback(response) {
      apiError();
    });
  };
});
/*---- Clientes ----*/
app.controller('clientController', function($scope,$routeParams, $http) {
  $scope.obj = {};
  $scope.form = {};
  $scope.lista = {};
  $scope.clean = function (){
    $scope.message = "";
    $scope.state = "";
    $scope.form = {};
    $scope.form.extra = "";
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
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.updateList = function (){
    $http({
      method: 'GET',
      url: baseapi+'/cliente'
    }).then(function successCallback(response) {
      $scope.lista = response.data;
      test = response.data;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.eliminar = function(uid){
    if(confirm("¿Esta seguro que quiere eliminar el cliente?")){
      $http({
        method: 'DELETE',
        url: baseapi+'/cliente/'+uid
      }).then(function successCallback(response) {
        $scope.updateList();
      }, function errorCallback(response) {
        apiError();
      });
    }
  };
  $scope.submitForm = function() {
    $http({
      method  : 'POST',
      url     : baseapi+'/cliente',
      data: $scope.form,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback(data){
      if (data.data) {
        $scope.clean();
        $scope.state = "success";
        $scope.message = "Cliente cargado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    }, function errorCallback(response) {
      apiError();
    });

  };
  $scope.updateClient = function(id = $routeParams.id) {
    $http({
      method  : 'PATCH',
      url     : baseapi+'/cliente/'+id,
      data: "nombre="+$scope.form.nombre+"&telefono="+$scope.form.telefono+"&extra="+$scope.form.extra,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback(data){
      if (data.data) {
        $scope.state = "success";
        $scope.message = "Cliente actualizado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    }, function errorCallback(response) {
      apiError();
    });
  };
});
/*---- Proveedores ----*/
app.controller('providerController', function($scope,$routeParams,$rootScope, $http) {
  $scope.obj = {};
  $scope.form = {};
  $scope.lista = {};
  $scope.clean = function (){
    $scope.message = "";
    $scope.state = "";
    $scope.form = {};
    $scope.form.email = "";
    $scope.form.web = "";
    $scope.form.extra = "";
  };
  $scope.setDeuda = function(client){
    var deuda = 0;
    Array.from(movimientos).forEach(function(mov){
      if(mov.tipo == '0' && mov.uid == client.id){
        deuda = parseInt(deuda) + parseInt(mov.total);
        deuda = parseInt(deuda) - parseInt(mov.entregado);
      }
    });
    if(isNaN(deuda)){
      deuda = 0;
    }
    client.deuda = deuda;
  };
  $scope.updateObj = function(id){
    $http({
      method: 'GET',
      url: baseapi+'/proveedor/'+id
    }).then(function successCallback(response) {
      $scope.obj = response.data;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.getProvider = function(id = $routeParams.id){
    $http({
      method: 'GET',
      url: baseapi+'/proveedor/'+id
    }).then(function successCallback(response) {
      $scope.form = response.data;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.updateList = function (){
    $http({
      method: 'GET',
      url: baseapi+'/proveedor'
    }).then(function successCallback(response) {
      $scope.lista = response.data;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.eliminar = function(uid){
    if(confirm("¿Esta seguro que quiere eliminar el proveedor?")){
      $http({
        method: 'DELETE',
        url: baseapi+'/proveedor/'+uid
      }).then(function successCallback(response) {
        $scope.updateList();
      }, function errorCallback(response) {
        apiError();
      });
    }
  };
  $scope.submitForm = function() {
    $http({
      method  : 'POST',
      url     : baseapi+'/proveedor',
      data: $scope.form,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback(data){
      if (data.data) {
        $scope.clean();
        $scope.state = "success";
        $scope.message = "Proveedor cargado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.updateProvider = function(id = $routeParams.id) {
    $http({
      method  : 'PATCH',
      url     : baseapi+'/proveedor/'+id,
      data: "nombre="+$scope.form.nombre+"&telefono="+$scope.form.telefono+"&email="+$scope.form.email+"&web="+$scope.form.web+"&extra="+$scope.form.extra,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback(data){
      if (data.data) {
        $scope.state = "success";
        $scope.message = "Proveedor actualizado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    }, function errorCallback(response) {
      apiError();
    });
  };
});
/*---- Movimientos ----*/
app.controller('movController', function($scope,$routeParams, $http) {
  $scope.obj = {};
  $scope.form = {};
  $scope.lista = {};
  $scope.clean = function (){
    $scope.message = "";
    $scope.state = "";
    $scope.form = {};
    $scope.form.extra = "";
  };
  $scope.updateObj = function(mov){
    $scope.obj = mov;
  };
  $scope.getMov = function(mov){
    $scope.form = mov;
  };
  $scope.getResumen = function(fecha){
    var movs = {};
    var subint = 0;
    switch (fecha) {
      case "dia":
        subint = 10;
        break;
      case "mes":
        subint = 7;
        break;
      case "año":
        subint = 4;
        break;
    }
    $http({
      method: 'GET',
      url: baseapi+'/movimiento/creado/$'+(new Date().toISOString().slice(0, 19).replace('T', ' ')).substr(0,subint)
    }).then(function successCallback(response) {
      movs = response.data;
      var datos = {};
      datos.ventas = 0;
      datos.ingresos = 0;
      datos.egresos = 0;
      angular.forEach(movs, function(mov) {
        if(mov.tipo == "1"){
          datos.ventas++;
          datos.ingresos += parseFloat(mov.entregado);
        }
        else{
          datos.egresos += parseFloat(mov.entregado);
        }
      });
      datos.total = datos.ingresos - datos.egresos;
      $scope.resumen = datos;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.updateList = function (){
    $http({
      method: 'GET',
      url: baseapi+'/movimiento'
    }).then(function successCallback(response) {
      $scope.lista = response.data;
    }, function errorCallback(response) {
      apiError();
    });
  };
  $scope.eliminar = function(uid){
    if(confirm("¿Esta seguro que quiere eliminar el movimiento?")){
      $http({
        method: 'DELETE',
        url: baseapi+'/movimiento/'+uid
      }).then(function successCallback(response) {
        $scope.updateList();
      }, function errorCallback(response) {
        apiError();
      });
    }
  };
  $scope.updateMov = function(id = $routeParams.id) {
    $http({
      method  : 'PATCH',
      url     : baseapi+'/movimiento/'+id,
      data: "total="+$scope.form.total+"&entregado="+$scope.form.entregado+"&detalle="+$scope.form.detalle,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback (data){
      if (data.data) {
        $scope.state = "success";
        $scope.message = "Movimiento actualizado correctamente.";
        $scope.updateList();
      } else {
        $scope.state = "error";
        $scope.message = "Verifique que los datos sean correctos.";
      }
    }, function errorCallback(response) {
      apiError();
    });
  };
});
