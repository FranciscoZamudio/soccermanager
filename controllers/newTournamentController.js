//we inject the controller with a model
moduleApp.controller("newTournamentController", function($scope, ticketsService, $http){



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



$scope.master = {};

$scope.createTournament = function(tournament) {
  //var info = 'action=addTicket' + '&ticketInfo=' + JSON.stringify(tournament);
  //$scope.postData(info);
  console.log($scope.players);
};


$scope.playersInput = function(numberPlayers) {
  $scope.players = [];
  for (i = 0; i < numberPlayers; i++) {
    $scope.players.push({name:''});
  }
};


});
