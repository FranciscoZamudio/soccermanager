moduleApp.controller('saveTournamentController', function($scope, $http) {
  $scope.tournamentTable = {};

  $scope.getData = function(){
      $http({
            method : "GET",
            url : "./controllers/saveTournament.php?getTournaments=gt"
        }).then(function mySuccess(response) {
            $scope.tournamentTable = response.data;
        }, function myError(response) {
            console.log("there was an error");
        });
  };

  $scope.init = function(){
    $scope.getData();
  };

  $scope.init();

});
