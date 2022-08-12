<?php
$servername = "sql102.epizy.com";

$username = "epiz_31690289";

$password = "OrDxagsDp5P";

$dbname = "epiz_31690289_mjames";


$conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}
 ?>  