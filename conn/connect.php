<?php

$host = "localhost";
$username = "u126355527_savelyn";
$password = "Naufalgaming321";
$db = "u126355527_employee_db";

$connect = new mysqli($host, $username, $password, $db);

if ($connect->connect_error)
    die("Connection failed: " . $conn->connect_error);

?>