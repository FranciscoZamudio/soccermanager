<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
//include(__ROOT__.'');
require_once('../connection.php');
require_once('Player.php');



class Tournament{
  private $id;
  private $date;
  private $status;
  private $winnerPlayer;
  private $winnerTeam;

  function __construct($id, $date, $status, $wPlayer, $wTeam){
    $this->id = $id;
    $this->date = $date;
    $this->status = $status;
    $this->$winnerPlayer = $wPlayer;
    $this->$winnerTeam = $sTeam;
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
      $player = new Player($conn);
      $name = $pl->name;
      $teams = $teamsArray[$key];
      $player->createPlayer($tournamentID, $name, $teams);
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
          //$tournamentsArray[] = $row;//objeto tipo tournament ver como acceder arriba hay ejemplo
          $tournamentsArray[] = new Tournament($row["id_tournament"], $row["datecreated"], $row["finish"], $row["winner_team"], $row["winner_name"]);
      }
    }
    echo json_encode($tournamentsArray);
  }


}
?>
