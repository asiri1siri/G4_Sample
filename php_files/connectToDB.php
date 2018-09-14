<?php

    $host = "localhost"; 
    $username = "root";
    $password = "password"; 
    $database = "presdproj";

    try
    {
        $conn = new mysqli($host, $username, $password, $database);
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

?>