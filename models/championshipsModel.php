<?php
include_once '../connection.php';
//require(__ROOT__.'/models/queries.php');

$dashboard = new Dashboard($conn);

if(isset($_GET["getTournaments"]) && !empty($_GET["getTournaments"]) && $_GET["getTournaments"] == "gt"){
    $dashboard->getTournaments();
};



class Dashboard{
  private $conn;

  function __construct($conn){
    $this->conn = $conn;
  }

  function getTournaments(){
    $tournamentsArray = array();
    $stmt = $this->conn->query("SELECT * FROM tournament order by id_tournament desc");
    if ($stmt->num_rows > 0) {
      while( $row = $stmt->fetch_assoc() ) {
          $tournamentsArray[] = $row;
      }
    }
    echo json_encode($tournamentsArray);
  }

}
?>
