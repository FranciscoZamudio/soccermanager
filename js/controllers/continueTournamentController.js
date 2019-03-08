//we inject the controller with a model
moduleApp.controller("continueTournamentController", function($scope, $stateParams, $http){

  $scope.tournament = {};

  $scope.getData = function(){
      $http({
            method : "GET",
            url : "./controllers/continueTournament.php?getTournaments=gt",
            params: {id: $stateParams.tournamentId}
        }).then(function mySuccess(response) {
            var tournament = response.data;
            console.log(tournament);
            //$scope.tournament = JSON.parse(tournament);
            //console.log($scope.tournament.getStatus());
        }, function myError(response) {
            console.log("there was an error");
        });
  };

  $scope.postData = function(info){
    $http({
          url : "./models/ticketsModel.php",
          method: 'POST',
          data: info,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function mySuccess(response) {
          console.log("the ticket has been registered");
      }, function myError(response) {
          console.log("there was an error");
      });
  };



  $scope.init = function(){
    $scope.getData();
  };

  $scope.init();


});
