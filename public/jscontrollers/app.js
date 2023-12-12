let app = angular.module('App', ["ui.router"]);

app.controller('AppController', function ($scope, $http) {
});

app.controller('app.starships', function ($scope, $http) {
    $http.get('/swapi/starships/').then(function (response) {
        $scope.starships = response.data;
    });

    $http.get('/swapi/pilotos').then(function (response) {
        $scope.pilotos = response.data;
    });
    $http.get('/relaciones').then(function (response) {
        $scope.relaciones = response.data;
        console.log($scope.relaciones);
    });
});


app.controller('app.relacion', function ($scope, $http) {
});


app.controller('app.pilotos', function ($scope, $http) {

    $http.get('/swapi/starships/').then(function (response) {
        $scope.starships = response.data;
    });

    $http.get('/swapi/pilotos').then(function (response) {
        $scope.pilotos = response.data;
    });
    $scope.getRelaciones = function() {
        $http.get('/relaciones').then(function (response) {
            $scope.relaciones = response.data;
        });
    };

    $scope.getRelaciones();

    $scope.getPilotosRelacionados = function(starship) {
        return $scope.relaciones.filter(function(relacion) {
            return relacion.starship_id === starship.id;
        });
    };


    $scope.showIds = function () {
        $http.get('/relaciones').then(function (response) {
            $scope.relaciones = response.data;
            // console.log($scope.relaciones);

            console.log(toastr);
            toastr.info("relacion añadida con exito")
        });
    };


    $scope.addRelation = function(piloto, starship) {
        // Enviar solicitud POST a Laravel para manejar la relación
        $http.post('/relacion', { 
            pilotoId: piloto.id, 
            starshipId: starship.id,
            pilotoName: piloto.name,
            starshipName: starship.name 
        }).then(function(response) {
                console.log('Relación añadida con éxito');
                console.log('Piloto:', piloto.name);
                console.log('Starship:', starship.name);
                $scope.getRelaciones();
                toastr.success("Relación añadida con éxito");
            })
            .catch(function(error) {
                console.error('Error al añadir la relación', error);
                $scope.errorMessage = 'Error al añadir la relación';
            });    
    };

    $scope.deleteRelation = function(piloto, starship) {
        // Enviar solicitud POST a Laravel para eliminar la relación
        $http.post('/eliminar-relacion', { 
            pilotoId: piloto.id, 
            starshipId: starship.id
        }).then(function(response) {
                console.log('Relación eliminada con éxito');
                $scope.getRelaciones();
                toastr.error('Relación eliminada con éxito');
            })
            .catch(function(error) {
                console.error('Error al eliminar la relación', error);
            });
    };
});



app.controller('app.conversion', function ($scope, $http) {

    $http.get('/swapi/starships/').then(function (response) {
        $scope.starships = response.data;
    });


    $scope.convertirBase15 = function(starship) {
        // Obtener el valor del input en base decimal
        var numeroDecimal = starship.numeroDecimal;
        // console.log(starship.numeroDecimal);
        // console.log($scope.starship.numeroDecimal);

        if (isNaN(numeroDecimal) || numeroDecimal < 0 || numeroDecimal % 1 !== 0) {
            alert('Por favor, introduce un número entero no negativo.');
            return;
        }

        // Realizar la conversión a base 15 utilizando los símbolos específicos
        var simbolosBase15 = ['0','1','2','3','4','5','6','7','8','9', 'ß', 'Þ', '¢', 'µ', '¶'];
        var resultadoBase15 = '';

        do {
            var residuo = numeroDecimal % 15;
            resultadoBase15 = simbolosBase15[residuo] + resultadoBase15;
            numeroDecimal = Math.floor(numeroDecimal / 15);
        } while (numeroDecimal > 0);

       

        // Mostrar el resultado en la etiqueta <h1>
        starship.resultadoBase15 = resultadoBase15;

        starship.aplicar = "true";
    };
});


app.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise(function ($injector, $location) {
        let $state = $injector.get('$state');
        $state.go('/');
        return true;
    });

    $stateProvider.state('home', {
        url: '/',
        templateUrl: "/html/home.html",
        controller: 'AppController',
        controllerAs: "vm",   
    }).state('naves', {
        url: '/naves',
        templateUrl: "/html/naves.html",
        data: {title: 'Naves'},
        controller: 'app.starships',
        controllerAs: "vm",
    }).state('pilotos', {
        url: '/pilotos',
        templateUrl: "/html/pilotos.html",
        controller: 'app.pilotos',
        controllerAs: "vm",
    }).state('conversion', {
        url: '/conversion',
        templateUrl: "/html/conversion.html",
        controller: 'app.conversion',
        controllerAs: "vm",
    })
});