<?php

    $conn = new mysqli(hostname: "localhost", username: "root", password: "", database: "phpipod");
    
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    $conn->set_charset(charset: "utf8");

?>
