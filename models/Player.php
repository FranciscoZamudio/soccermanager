<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
//include(__ROOT__.'/connection.php');



class Player implements \JsonSerializable{
  private $conn;
  private $id;
  private $name;
  private $team1;
  private $team2;
  private $team3;
  private $team4;

  function __construct($conn, $id){
    $this->conn = $conn;
    $this->setProperties($id);
  }

  function setProperties($id){
    $stmt = $this->conn->query("SELECT * FROM player WHERE id_tournament = '".$id."' ");
    if ($stmt->num_rows > 0) {
      while( $row = $stmt->fetch_assoc() ) {
          $this->id = $row["id_user"];
          $this->name = $row["name"];
          $this->team1 = $row["team1"];
          $this->team2 = $row["team2"];
          $this->team3 = $row["team3"];
          $this->team4 = $row["team4"];
      }
    }
  }

  public function jsonSerialize() {
        return array(
            'playerid' => $this->id,
            'name' => $this->name,
            'team1' => $this->team1,
            'team2' => $this->team2,
            'team3' => $this->team3,
            'team4' => $this->team4
        );
  }

  function getId(){
    return $this->id;
  }

  function getName(){
    return $this->name;
  }

  function getTeam1(){
    return $this->$team1;
  }

  function getTeam2(){
    return $this->$team2;
  }

  function getTeam3(){
    return $this->$team3;
  }

  function getTeam4(){
    return $this->$team4;
  }

  static function createPlayer($conn, $tournamentID, $name, $teams){
      $stmt = $conn->prepare("INSERT INTO player(id_tournament, name, team1, team2, team3, team4) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssss", $tournamentID, $name, $teams[0], $teams[1], $teams[2], $teams[3]);
      $stmt->execute();
      $stmt->close();
  }


}
?>
