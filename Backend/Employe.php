<?php 
require_once(__DIR__.'/ConnectToDb.php');

function GetEmployes(){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Employe";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll();

    return $data;
}

function GetEmployesByRole($IdRole)  {
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Employe WHERE IdRole = :IdRole";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['IdRole' => $IdRole]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetEmployeById($Id){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Employe WHERE Id = :Id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Id' => $Id]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetEmployesByNom($Nom){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Employe WHERE Nom = :Nom";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Nom' => $Nom]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetEmployesByPrenom($Prenom){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Employe WHERE Prenom = :Prenom";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Prenom' => $Prenom]);

    $data = $stmt->fetchAll();

    return $data;
}

function GetEmployesByAdresseMail($AdresseMail){
    $pdo = ConnectToDb();
    $sql = "SELECT * FROM Employe WHERE AdresseMail = :AdresseMail";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['AdresseMail' => $AdresseMail]);

    $data = $stmt->fetchAll();

    return $data;
}

function CreateEmploye($Nom , $Prenom , $AdresseMail = null, $AdressePostale = null, $Telephone = null, $Role, $TokenGoogleAgenda = null, $Password){
    $pdo = ConnectToDb();
    $sql = "INSERT INTO Employe(Nom, Prenom, AdresseMail, AdressePostale, Telephone, IdRole, TokenGoogleAgenda, Password) VALUES (:Nom, :Prenom, :AdresseMail, :AdressePostale, :Telephone, :Role, :TokenGoogleAgenda, :Password)";

    $stmt = $pdo->prepare($sql);

    $Password = encrypt_password($Password);

    $stmt->execute(['Nom' => $Nom, 'Prenom' => $Prenom, 'AdresseMail' => $AdresseMail, 'AdressePostale' => $AdressePostale, 'Telephone' => $Telephone, 'Role' => $Role, 'TokenGoogleAgenda' => $TokenGoogleAgenda, 'Password' => $Password]);
}


function UpdateEmploye($Id, $Nom = null , $Prenom = null , $AdresseMail = null , $AdressePostale = null , $Telephone = null, $Role = null, $TokenGoogleAgenda = null, $Password = null){
    //Attention lors de l'utilisation de la fonction UpdateEmploye, il faut mettre en paramètre toutes les valeurs de l'employé, même celles qui ne sont pas modifiées
    $pdo = ConnectToDb();

    $previousData = GetEmployeById($Id);

    if($Nom == null){
        $Nom = $previousData[0]->Nom;
    }
    if($Prenom == null){
        $Prenom = $previousData[0]->Prenom;
    }
    if($AdresseMail == null){
        $AdresseMail = $previousData[0]->AdresseMail;
    }
    if($AdressePostale == null){
        $AdressePostale = $previousData[0]->AdressePostale;
    }
    if($Telephone == null){
        $Telephone = $previousData[0]->Telephone;
    }
    if($Role == null){
        $Role = $previousData[0]->Role;
    }
    if($TokenGoogleAgenda == null){
        $TokenGoogleAgenda = $previousData[0]->TokenGoogleAgenda;
    }
    if($Password == null){
        $password = $previousData[0]->Password;
    }else{
        $Password = encrypt_password($Password);
    }

    $sql = "UPDATE Employe SET Nom = :Nom, Prenom = :Prenom, AdresseMail = :AdresseMail, AdressePostale = :AdressePostale, Telephone = :Telephone, IdRole = :IdRole, TokenGoogleAgenda = :TokenGoogleAgenda, Password = :Password WHERE Id = :Id";

    $stmt = $pdo->prepare($sql);



    $stmt->execute(['Id' => $Id, 'Nom' => $Nom, 'Prenom' => $Prenom, 'AdresseMail' => $AdresseMail, 'AdressePostale' => $AdressePostale, 'Telephone' => $Telephone, 'IdRole' => $Role, 'TokenGoogleAgenda' => $TokenGoogleAgenda, 'Password' => $Password]);
}

function DeleteEmploye($Id){
    $pdo = ConnectToDb();
    $sql = "DELETE FROM Employe WHERE Id = :Id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['Id' => $Id]);
}

function GetEmployesSort($Sort){
    $pdo = ConnectToDb();

    if($Sort == 0){
        return GetEmployes();
    }

    $sql = "SELECT * FROM Employe ORDER BY $Sort";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll();
    return $data;
}

function GetIdRoles(){
    $pdo = ConnectToDb();
    $sql = "SELECT DISTINCT IdRole FROM Employe";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll();

    return $data;
}

function encrypt_password($password){
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    return $encrypted_password;
}

?>