<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/connection.php');
require_once(__ROOT__.'/models/Tournament.php');

//action is  create a tournament
if(isset($_POST["action"]) && !empty($_POST["action"]) && $_POST["action"] == "addTournament"){
  if(isset($_POST["tournamentInfo"]) && !empty($_POST["tournamentInfo"])){
    Tournament::createTournament($conn, $_POST["tournamentInfo"], $_POST["players"]);
    //$tournament = new Tournament();
    //$tournament->createTournament(json_decode($_POST["tournamentInfo"], true));
    //createTournament(json_decode($_POST["tournamentInfo"], true), json_decode($_POST["players"], true));
    //$player->createPlayer(json_decode($_POST["tournamentInfo"], true));
  }
};
?>
