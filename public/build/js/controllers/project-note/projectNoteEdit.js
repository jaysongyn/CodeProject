angular.module('app.controllers')
    .controller('ProjectNoteEdittController',
    ['$scope','$location','ProjectNote', '$routeParams',
        function($scope,$location, ProjectNote,$routeParams) {
        $scope.projectNote =  ProjectNote.get({id: null, idNote:$routeParams.idNote});

        $scope.save = function(){
           if($scope.form.$valid){
               ProjectNote.update({id:null, idNote:$routeParams.idNote},$scope.projectNote,function(){
                   $location.path('/project/' + $routeParams.id + "/notes" );
               });
           }
        }
    }]);
