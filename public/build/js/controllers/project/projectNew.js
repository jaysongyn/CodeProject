angular.module('app.controllers')
    .controller('ProjectNewtController',['$scope','$location','Project','Client','appConfig','$cookies',
        function($scope,$location, Project,Client,appConfig,$cookies) {
        $scope.project = new Project();
        $scope.clients = new Client.query();
        $scope.status = appConfig.project.status;


        $scope.save = function(){
           if($scope.form.$valid){
               $scope.project.owner_id = $cookies.getObject ('user').id;
                $scope.project.$save().then(function(){
                    $location.path('/projects' );
                });
           }else {
               console.log("aqui");
           }
        }
    }]);
