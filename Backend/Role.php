<?php
require_once(__DIR__.'/ConnectToDb.php');

function GetRoles(){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM role";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll();

    return $data;
}

function GetRoleById($Id){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM role WHERE idtypework = :Id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Id' => $Id]);

    $data = $stmt->fetchAll();

    return $data;
}

?>