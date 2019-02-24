<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/connection.php');
require_once(__ROOT__.'/models/Tournament.php');

//get all tournaments that havent finish
if(isset($_GET["getTournaments"]) && !empty($_GET["getTournaments"]) && $_GET["getTournaments"] == "gt"){
    Tournament::getTournaments($conn);
};
?>
