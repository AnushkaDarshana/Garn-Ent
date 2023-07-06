<?php
    $servername = "localhost";
    $username = "root";
    $password = "";  // if you didn't set a password for MySQL, leave this empty
    $dbname = "garn_enterprices";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
