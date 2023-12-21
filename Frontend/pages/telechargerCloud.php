<?php
require_once('../../backend/ConnectToDb.php');
ini_set('display_errors', '1');
    
    $conn = ConnectToDb();  

    if (isset($_GET['nom'])) {
        $nomFichier = $_GET['nom'];
        $sql = "SELECT contenu FROM Fichiers WHERE nom = :nom";
        $req = $conn->prepare($sql);
        $req->bindParam(':nom', $nomFichier);
        $req->execute();

        if ($req->rowCount() > 0) {
            $row = $req->fetch(PDO::FETCH_ASSOC);
            $contenu = $row["contenu"];

            header("Content-Disposition: attachment; filename=$nomFichier");
            header("Content-Type: application/octet-stream");
            echo $contenu;
        }
        else {
            echo "Fichier non trouvé";
        }
    }
    else {
        echo "Nom de fichier non spécifié";
    }

    $conn = null;
?>

