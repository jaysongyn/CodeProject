angular.module('app.controllers')
    .controller('ProjectNewtController', ['$scope', '$location', 'Project', 'Client', 'appConfig', '$cookies',
        function ($scope, $location, Project, Client, appConfig, $cookies) {
            $scope.project = new Project();
            $scope.clients = new Client.query();
            $scope.status = appConfig.project.status;


            $scope.due_date = {
                status: {
                    opened: false
                }
            };

            $scope.open = function($event){
                $scope.due_date.status.opened = true;
            };



            $scope.formatName = function (id) {
                if(id){
                    for (var i in $scope.clients) {
                        if ($scope.clients[i].id == id) {
                            return $scope.clients[i].name
                        }
                    }
                }
                return '';

            }
            $scope.getClients = function (name) {
              return Client.query({
                  search:name,
                  searchFields:'name:like'
              }).$promise;
            }
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    });
                } else {
                    console.log("aqui");
                }
            }
        }]);
