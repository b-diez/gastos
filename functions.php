<?php

    function read_from_file($filename) {
        $file = fopen($filename, "r") or die("Unable to open file!");
        $content = fread($file,filesize($filename));
        return $content;
    }
    
    function sql_connect() {
        $servername = "*****";
        $database = "*****";
        $username = "*****";
        $password = "*****";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        $conn->set_charset("utf8");
        
        // Check connection
        if ($conn->connect_error) {
          echo "I'm dead";
          die("Connection failed: " . $conn->connect_error);
        } 
        
        return $conn;
    }
?>