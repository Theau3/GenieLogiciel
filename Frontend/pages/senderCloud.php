<?php require_once('../../backend/ConnectToDb.php');
ini_set('display_errors', 1);
$conn = ConnectToDb();
?>

<!-- envoi au serveur -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $nom_fichier = $_FILES["file"]["name"];
        $taille_fichier = $_FILES["file"]["size"];
        $type_fichier = $_FILES["file"]["type"];
        $chemin_temporaire = $_FILES["file"]["tmp_name"];

        $contenu_fichier = file_get_contents($chemin_temporaire);
        $sql = "INSERT INTO Fichiers (nom, taille, type, contenu) VALUES (:nom, :taille, :type, :contenu)";
        $req = $conn->prepare($sql);
        $req->bindParam(':nom', $nom_fichier);
        $req->bindParam(':taille', $taille_fichier);
        $req->bindParam(':type', $type_fichier);
        $req->bindParam(':contenu', $contenu_fichier, PDO::PARAM_LOB);

        if ($req->execute()) {
            echo "Le fichier a été stocké dans la base de données avec succès";
        }
        else {
            echo "Erreur lors de l'insertion dans la base de données";
        }
    }
    else {
        echo "Erreur lors du téléversement";
    }
}

$conn = null;
?>



