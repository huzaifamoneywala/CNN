<?php
// Database credentials
$host = "localhost";
$user = "uyneengacpnz5";
$password = "yq8amjwdkzqf";
$dbname = "dbnsx1cz9pdy6q";

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to UTF-8
$conn->set_charset("utf8");
?>
