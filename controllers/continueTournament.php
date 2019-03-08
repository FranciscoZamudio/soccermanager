<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/connection.php');
require_once(__ROOT__.'/models/Tournament.php');

//get current/open tournament
if(isset($_GET["getTournaments"]) && !empty($_GET["getTournaments"]) && $_GET["getTournaments"] == "gt"){
    //crear una funcion que me retorne un objeto tourneo con el id acordado.
    $tournament = new Tournament($conn, $_GET["id"]);
    $tournament = (array)$tournament;
    //$arrayPlayers = array();
    //print_r($tournament);
    //print_r($tournament["Tournamentdate"]);
    //exit();
    //foreach ($tournament["Tournamentplayers"] as $playerobj){
      //$arrayPlayers[] = (array)$playerobj;
  //  }
    //print_r($arrayPlayers);
    //exit();
    //$tournament["Tournamentplayers"] = $arrayPlayers;
    //$t = array($tournament->getStatus();
    echo json_encode($tournament);
}
?>
