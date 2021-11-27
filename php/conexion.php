<?php
    $host = 'localhost';
    $user = 'root';
    $password =  '';
    $database = 'Stocksystem';

    $conn = @mysqli_connect($host,$user,$password,$database);
    if (!$conn) {
        echo "Error en la conexión";
    }

?>


