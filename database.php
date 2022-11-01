<?php
    $serverName = "localhost" ;
    $userName = "root";
    $passWord = "rainoverme" ;
    $dataBaseName = "scrumboard" ;

    $connection = mysqli_connect($serverName, $userName, $passWord, $dataBaseName);

    if(!$connection){
        echo "connection is failed".mysqli_connect_errno() ;
    }
?>