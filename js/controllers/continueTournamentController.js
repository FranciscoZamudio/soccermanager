//we inject the controller with a model
moduleApp.controller("continueTournamentController", function($scope, $http){
  var tournament = '{'+
'"status": 0,'+
'"players" : ['+
'{ "name":"John" , "team1":"barcelona", "team2":"Borusia Dourtmund", "team3":"Inter", "team4":"Lyon" },' +
'{ "name":"Anna" , "team1":"Real Madrid", "team2":"Liverpool", "team3":"Manchester City", "team4":"PSG" },' +
'{ "name":"Felipe" , "team1":"Atletico Madrid", "team2":"Manchester United", "team3":"Arsenal", "team4":"Milan" } ]}';
  $scope.tournament = JSON.parse(tournament);
  console.log($scope.tournament);
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
