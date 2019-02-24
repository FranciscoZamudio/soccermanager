<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
//include(__ROOT__.'/connection.php');



class Player{
  private $conn;
  private $id;
  private $name;
  private $team1;
  private $team2;
  private $team3;
  private $team4;

  function __construct($conn){
    $this->conn = $conn;
  }

  function createPlayer($tournamentID, $name, $teams){
      $stmt = $this->conn->prepare("INSERT INTO player(id_tournament, name, team1, team2, team3, team4) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssss", $tournamentID, $name, $teams[0], $teams[1], $teams[2], $teams[3]);
      $stmt->execute();
      $stmt->close();
  }


}
?>
