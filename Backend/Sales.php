<?php 

require_once(__DIR__.'/ConnectToDb.php');

function GetSales(){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
 
    $data = $stmt->fetchAll();

    return $data;
}

//make a function GetSupportById($idSupport) that returns the support name
function GetSupportById($SupportID){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Supports WHERE SupportID = :SupportID";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['SupportID' => $SupportID]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetGameByID($GameID){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Games WHERE GameID = :GameID";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['GameID' => $GameID]);

    $data = $stmt->fetchAll();

    return $data;
}
function GetSalesByID($idSales){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Ventes WHERE idSales = :idSales";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['idSales' => $idSales]);

    $data = $stmt->fetchAll();

    return $data;
}


function GetSalesSort($sort){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes ORDER BY $sort";
  
    $stmt = $pdo->prepare($sql);
  
    $stmt->execute();
  
    $data = $stmt->fetchAll();
  
    return $data;
  }

//make a function named search by game name
function SearchByGameName($GameName){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Games WHERE Name LIKE :GameName";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['GameName' => $GameName]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetGameName(){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Games";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll();

    return $data;
}

function GetGameSupport(){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Supports";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll();

    return $data;
}

function GetSalesByGameNameSupportSort($GameName, $Support, $Sort){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes WHERE GameID = :GameName AND SupportID = :Support ORDER BY $Sort";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['GameName' => $GameName, 'Support' => $Support]);

    $data = $stmt->fetchAll();

    return $data;
}
function GetSaleBySort($Sort){
    $pdo = ConnectToDb();

    if($Sort == 'Id'){
        return GetSales();
    }

    $sql = "SELECT * FROM Ventes ORDER BY $Sort";
  
    $stmt = $pdo->prepare($sql);
  
    $stmt->execute();
  
    $data = $stmt->fetchAll();
  
    return $data;
}

function GetSalesByGame($Game){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes WHERE GameID = :Game";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Game' => $Game]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetSalesBySupport($Support){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes WHERE SupportID = :Support";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Support' => $Support]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetSalesByGameAndSupport($Game, $Support){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes WHERE GameID = :Game AND SupportID = :Support";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Game' => $Game, 'Support' => $Support]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetSalesByGameNameSort($GameName, $Sort){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes WHERE GameID = :GameName ORDER BY $Sort";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['GameName' => $GameName]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetSalesBySupportSort($Support, $Sort){
    $pdo = ConnectToDb();

    $sql = "SELECT * FROM Ventes WHERE SupportID = :Support ORDER BY $Sort";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Support' => $Support]);

    $data = $stmt->fetchAll();

    return $data;
}
?>