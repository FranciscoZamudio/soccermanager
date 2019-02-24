<?php
include_once '../connection.php';
include_once '../models/Tournament.php';


//action is  create a tournament
if(isset($_POST["action"]) && !empty($_POST["action"]) && $_POST["action"] == "addTournament"){
  if(isset($_POST["tournamentInfo"]) && !empty($_POST["tournamentInfo"])){
    Tournament::createTournament($conn, $_POST["tournamentInfo"], $_POST["players"]);
  }
};
?>
