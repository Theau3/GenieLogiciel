<?php 

require_once(__DIR__.'/ConnectToDb.php');

function GetAcces(){
  $pdo = ConnectToDb();
  $sql = "SELECT * FROM Acces";

  $stmt = $pdo->prepare($sql);

  $stmt->execute();

  $data = $stmt->fetchAll();

  return $data;
}

function GetAccesByIdEmploye($IdEmploye) {
  $pdo = ConnectToDb();
  $sql = "SELECT * FROM Acces WHERE IdEmploye = :IdEmploye";

  $stmt = $pdo->prepare($sql);

  $stmt->execute(['IdEmploye' => $IdEmploye]);

  $data = $stmt->fetchAll();

  return $data;
  
}

function GetAccesById($Id){
  $pdo = ConnectToDb();
  $sql = "SELECT * FROM Acces WHERE Id = :Id";

  $stmt = $pdo->prepare($sql);

  $stmt->execute(['Id' => $Id]);

  $data = $stmt->fetchAll();

  return $data;
}

function AddAcces($IdEmploye){
  $pdo = ConnectToDb();
  $DateTime = date("Y-m-d H:i:s");
  
  $sql = "INSERT INTO Acces(IdEmploye, DateTime) VALUES (:IdEmploye, :DateTime)";

  $stmt = $pdo->prepare($sql);

  $stmt->execute(['IdEmploye' => $IdEmploye, 'DateTime' => $DateTime]);
}

function GetAccesSort($sort){
  $pdo = ConnectToDb();
  $sql = "SELECT * FROM Acces ORDER BY $sort";

  $stmt = $pdo->prepare($sql);

  $stmt->execute();

  $data = $stmt->fetchAll();

  return $data;
}
  
?>