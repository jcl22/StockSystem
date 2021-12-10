<?php
    $host = 'localhost';
    $user = 'root';
    $password =  '';
    $database = 'Stocksystem';
    
    $conn = @mysqli_connect($host,$user,$password,$database);
        
    if (!$conn -> set_charset("utf8")) {
        echo "Error en la conexión";
    }

?>


