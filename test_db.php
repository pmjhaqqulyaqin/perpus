<?php
$mysqli = new mysqli("localhost", "mandalo1_slim423", "SG7(.pf288", "mandalo1_slim423");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
} else {
    echo "Successfully connected to MySQL!";
}
?>
