angular.module('app.controllers')
    .controller('ProjectEdittController',
    ['$scope','$location','Project', '$routeParams','appConfig','Client',
        function($scope,$location, Project,$routeParams,appConfig, Client) {

        $scope.project =  Project.get({id:$routeParams.id});
        $scope.clients = new Client.query();
        $scope.status = appConfig.project.status;

        $scope.save = function(){
           if($scope.form.$valid){
               Project.update({id:$routeParams.id},$scope.project,function(){
                   $location.path('/projects/');
               });
           }
        }
    }]);
