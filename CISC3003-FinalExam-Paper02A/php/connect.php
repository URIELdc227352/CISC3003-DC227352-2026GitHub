<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalexam_a";
$port = 2345;


$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>