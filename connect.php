<?php
$servername = "localhost";
$username = "lensidna_shuvo";
$password = "pakkna100";
$dbname = "lensidna_ivac";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>