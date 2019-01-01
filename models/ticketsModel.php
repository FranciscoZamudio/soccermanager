<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/connection.php');
require(__ROOT__.'/models/queries.php');

$ticket = new Tickets($conn);

if(isset($_POST["action"]) && !empty($_POST["action"]) && $_POST["action"] == "addTicket"){
  if(isset($_POST["ticketInfo"]) && !empty($_POST["ticketInfo"])){
    $ticket->addTicket(json_decode($_POST["ticketInfo"], true));
  }
};



class Tickets{

  private $conn;

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
