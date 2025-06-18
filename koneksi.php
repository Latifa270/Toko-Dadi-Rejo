<?php
$con = new mysqli("localhost", "root", "", "db_tokodadirejo", "3309");

//check connection
if ($con->connect_error) {
    die ("Connection failed: ". $con->connect_error);
}

?>
