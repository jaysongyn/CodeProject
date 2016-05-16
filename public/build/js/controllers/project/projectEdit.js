angular.module('app.controllers')
    .controller('ProjectEdittController',
    ['$scope', '$location', 'Project', '$routeParams', 'appConfig', 'Client',
        function ($scope, $location, Project, $routeParams, appConfig, Client) {

            Project.get({id: $routeParams.id}, function(data){
                $scope.project = data;
                $scope.project.status = parseInt(data.status);
                $scope.clientSelected =  data.client;
            });
           ;
            $scope.status = appConfig.project.status;

            $scope.formatName = function (model) {
                if (model) {
                    $scope.project.client_id = model.id;
                    return model.name;
                }
                return '';

            }
            $scope.getClients = function (name) {
                return Client.query({
                    search: name,
                    searchFields: 'name:like'
                }).$promise;
            }

            $scope.save = function () {
                if ($scope.form.$valid) {
                    Project.update({id: $routeParams.id}, $scope.project, function () {
                        $location.path('/projects/');
                    });
                }
            }
        }]);
