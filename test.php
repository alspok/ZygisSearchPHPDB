<?php

print("<a>Test sql connection</a><br>");

$username = "doadmin";
$password = "AVNS_sXck3RvigxdBy5-Jv1e";
$host = "db-mysql-fra1-43334-do-user-14106707-0.b.db.ondigitalocean.com";
$port = 25060;
$database = "defaultdb";
$sslmode = "REQUIRED";

// create connection
$conn = new mysqli($host, $username, $password, $database, $port, $sslmode);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<br><br>Connected successfully";
