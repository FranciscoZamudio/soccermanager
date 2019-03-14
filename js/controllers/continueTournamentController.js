//we inject the controller with a model

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
