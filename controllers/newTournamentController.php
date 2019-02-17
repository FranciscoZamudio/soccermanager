<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
//require(__ROOT__.'/connection.php');
//require(__ROOT__.'/models/queries.php');
require_once("models/Tournament.php");

//action is  create a tournament
if(isset($_POST["action"]) && !empty($_POST["action"]) && $_POST["action"] == "addTournament"){
  if(isset($_POST["tournamentInfo"]) && !empty($_POST["tournamentInfo"])){
    Tournament::createTournament();
    //$tournament = new Tournament();
    //$tournament->createTournament(json_decode($_POST["tournamentInfo"], true));
    //createTournament(json_decode($_POST["tournamentInfo"], true), json_decode($_POST["players"], true));
    //$player->createPlayer(json_decode($_POST["tournamentInfo"], true));
  }
};
?>
