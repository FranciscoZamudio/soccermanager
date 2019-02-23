//we inject the controller with a model
moduleApp.controller("newTournamentController", function($scope, $http){



  $scope.postData = function(info){
    $http({
          url : "./controllers/newTournamentController.php",
          method: 'POST',
          data: info,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function mySuccess(response) {
          console.log("the tournament has been registered");
      }, function myError(response) {
          console.log("there was an error");
      });
  };



$scope.master = {};

$scope.createTournament = function(tournament) {
  var info = 'action=addTournament' + '&tournamentInfo=' + JSON.stringify(tournament) + '&players=' + JSON.stringify($scope.players);
  $scope.postData(info);
  //llamar una funcion en modelo que cree
  console.log(info);
  console.log(tournament);
  console.log($scope.players);
};


$scope.playersInput = function(numberPlayers) {
  $scope.players = [];
  for (i = 0; i < numberPlayers; i++) {
    $scope.players.push({name:''});
  }
};


});
