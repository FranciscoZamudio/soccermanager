<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/connection.php');
require(__ROOT__.'/models/queries.php');

$tournament = new Tournament2($conn);

if(isset($_POST["action"]) && !empty($_POST["action"]) && $_POST["action"] == "addTournament"){
  if(isset($_POST["tournamentInfo"]) && !empty($_POST["tournamentInfo"])){
    $tournament->addTournament(json_decode($_POST["tournamentInfo"], true));
  }
};



class Tournament2{
  private $conn;
  private $id;

  function __construct($conn){
    $this->conn = $conn;
  }

  function addTicket($ticketInfo){
    $param1 = $ticketInfo["area"];
    $param2 = $ticketInfo["description"];
    $param3 = $ticketInfo["name"];
    $param4 = $ticketInfo["priority"];

    // prepare and bind

    $stmt = $this->conn->prepare("INSERT INTO tickets(area, description, name, priority) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $param1, $param2, $param3, $param4);
    $stmt->execute();
    $stmt->close();
    $this->conn->close();


    // $resultado = $mysqli->query("INSERT INTO tickets(name, area, type, description, priority, status) VALUES ();");
    // $fila = $resultado->fetch_assoc();
    // echo $fila['_msg'];
  }
}
?>
