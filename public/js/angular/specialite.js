app.controller('enseignementController', [
    '$scope',
    function($scope){
        $scope.enseignement = {
            mhRest : 0,
        };

        function calculMhRest (){
            $scope.enseignement.mhRest = parseInt($scope.enseignement.mhTotal) - parseInt($scope.enseignement.mhEff);
        }
    }
]);