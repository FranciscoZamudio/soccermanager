<?php
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__.'/config.php');




$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_errno) {
    echo "Fail connecting to MySQL: " . $conn->connect_error;
}
?>
