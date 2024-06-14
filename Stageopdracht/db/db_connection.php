<?php
    $host = "localhost";
    $db_name = "stageopdracht";
    $db_username = "root";
    $db_password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
?>