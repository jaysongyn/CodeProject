angular.module('app.controllers')
    .controller('ClientRemoveController',
    ['$scope','$location','Client', '$routeParams',
        function($scope,$location, Client,$routeParams) {
        $scope.client =  Client.get({id: $routeParams.id});

        $scope.remove = function(){

               $scope.client.$delete().then(function(){
                   $location.path('/client');
               });


        }
    }]);
