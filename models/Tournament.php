<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/connection.php');



class Tournament{
  private $conn;
  private $id;
  private $date;
  private $status;

  function __construct(){
    $this->conn = $conn;
  }

  function createTournament(){
    $currentDate = date("Y-m-d")

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO tournament(datecreated, finish) VALUES (?, ?)");
    $stmt->bind_param("si", $param1, 0);
    $stmt->execute();
    $stmt->close();
    $this->conn->close();
  }

  // function createTournament($ticketInfo){
  //   $param1 = $ticketInfo["area"];
  //   $param2 = $ticketInfo["description"];
  //   $param3 = $ticketInfo["name"];
  //   $param4 = $ticketInfo["priority"];
  //
  //   // prepare and bind
  //
  //   $stmt = $this->conn->prepare("INSERT INTO tournament(datecreated, finish, winner_team, winner_name) VALUES (?, ?, ?, ?)");
  //   $stmt->bind_param("ssss", $param1, $param2, $param3, $param4);
  //   $stmt->execute();
  //   $stmt->close();
  //   $this->conn->close();
  // }
}
?>
