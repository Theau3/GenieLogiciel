<?php

function ConnectToDb(){
    $user = 'u999818896_GenieLogiciel';
    $pass = 'GenieLogiciel1';
    $host = '145.14.156.1';
    $dbname = 'u999818896_GenieLogiciel';

    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    return $pdo;
}

?>