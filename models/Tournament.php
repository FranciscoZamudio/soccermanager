<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
//include(__ROOT__.'');
require_once('../connection.php');
require_once('Player.php');


class Tournament implements \JsonSerializable{
  private $date;
  private $status;
  private $winnerPlayer;
  private $winnerTeam;
  private $players = array();//players object array
  private $conn;//$conn comes from connection.php

  function __construct($conn, $id){
    $this->conn = $conn;
    $this->setProperties($id);
  }

  private function setProperties($id){
    $stmt = $this->conn->query("SELECT * FROM tournament WHERE id_tournament = '".$id."' ");
    if ($stmt->num_rows > 0) {
      while( $row = $stmt->fetch_assoc() ) {
          $this->date = $row["datecreated"];
          $this->status = $row["finish"];
          $this->winnerTeam = $row["winner_team"];
          $this->winnerPlayer = $row["winner_name"];
      }
    }

    //set my array of players
    $stmt = $this->conn->query("SELECT * FROM player WHERE id_tournament = '".$id."' ");
    if ($stmt->num_rows > 0) {
      while( $row = $stmt->fetch_assoc() ) {
          $this->players[] = json_encode(new Player($this->conn, $id));
      }
    }
  }

  public function jsonSerialize() {
        return array(
            'status' => $this->status,
            'players' => $this->players
        );
  }

  function getDate(){
    return $this->date;
  }
  function getStatus(){
    return $this->status;
  }
  function getWinnerTeam(){
    return $this->winnerTeam;
  }
  function getWinnerPlayer(){
    return $this->winnerPlayer;
  }
  function getPlayers(){
    return $this->players;
  }


  static function createTournament($conn, $tInfo, $p){
    $tournamentInfo = json_decode($tInfo);

    $date = date("Y-m-d");
    $finish = 0;//tournament status
    $tournamentType = $tournamentInfo->type;
    $numberPlayers = $tournamentInfo->players;
    $players = json_decode($p);

    //exit();
    //create tournament
    $stmt = $conn->prepare("INSERT INTO tournament(datecreated, finish) VALUES (?, ?)");
    $stmt->bind_param("si", $date, $finish);
    if ($stmt->execute()){
       $tournamentID = $stmt->insert_id;
    }
    $stmt->close();

    //$tournamentID = $conn->query("SELECT LAST_INSERT_ID()");//id of created tournamentInfo
    $teamsArray = Tournament::teamsArray($conn, $tournamentType, $numberPlayers);

    //create array of teams

    //create players
    //print_r($players);
    foreach($players as $key=>$pl) {
      //$player = new Player($conn);
      $name = $pl->name;
      $teams = $teamsArray[$key];
      Player::createPlayer($conn, $tournamentID, $name, $teams);
      $teams = array();
    }
    $conn->close();
  }

  private function teamsArray($conn, $tournamentType, $numberPlayers){
    $numberTeams = $numberPlayers*4;

    $tournamentsArray = array();
    $stmt = $conn->query("SELECT name FROM teams WHERE type = '".$tournamentType."' order by RAND() limit $numberTeams");
    if ($stmt->num_rows > 0) {
      while( $row = $stmt->fetch_assoc() ) {
          $tournamentsArray[] = $row["name"];
      }
    }
    return array_chunk($tournamentsArray, 4);
  }

  static function getTournaments($conn){
    $tournamentsArray = array();
    $stmt = $conn->query("SELECT * FROM tournament where finish = 0 order by id_tournament desc");
    if ($stmt->num_rows > 0) {
      while( $row = $stmt->fetch_assoc() ) {
          $tournamentsArray[] = $row;//objeto tipo tournament ver como acceder arriba hay ejemplo
          //$tournamentsArray[] = new Tournament($row["id_tournament"], $row["datecreated"], $row["finish"], $row["winner_team"], $row["winner_name"]);
      }
    }
    echo json_encode($tournamentsArray);
  }


}
?>
