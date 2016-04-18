angular.module('app.controllers')
    .controller('ProjectNoteRemoveController',
    ['$scope','$location','ProjectNote', '$routeParams',
        function($scope,$location, ProjectNote,$routeParams) {
            $scope.projectNote =  ProjectNote.get({id: null, idNote:$routeParams.idNote});

        $scope.remove = function(){

               $scope.projectNote.$delete({id: null, idNote:$routeParams.idNote}).then(function(){
                   $location.path('/project/' + $routeParams.id + "/notes" );
               });


        }
    }]);
