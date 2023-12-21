<?php require_once('../../backend/ConnectToDb.php');
ini_set('display_errors', '1');
require_once('./sidebar.php');
$conn = ConnectToDb();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!--JQUERY-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js%22%3E"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styleCloud.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <title>Téléversement fichiers</title>
</head>
<body>
    <div class="container">
        <?php Affiche_sidebar("Fichiers"); ?>

        
        <div class="container-cloud">
        
            <div class="header-section">
                <h1>Téléversement fichiers</h1>
                <p>Téléversez les fichiers ce que vous souhaitez.</p>
                <p>PDF, images et vidéos sont autorisés.</p>
            </div>
            <div class="drop-section">
                <div class="col">
                    <div class="cloud-icon">
                        <img src="icons/cloud.png" alt="cloud">
                    </div>
                    <span>Téléversez vos fichiers ici</span>
                    <span>OU</span>
                    <button class="file-selector">Parcourir les fichiers</button>
                    <input type="file" class="file-selector-input" multiple>
                </div>
                <div class="col">
                    <div class="drop-here">Téléversez ici
                    </div>
                </div>
            </div>
            <div class="list-section">
                <div class="list-title">Fichiers téléversés</div>
                <div class="list">
                    
                </div>
            </div>  
        </div>

        <div class="right-section">
            
            <!-- Nav Section -->
            <?php include('header.php'); ?>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>THE CATY</h2>
                    <p>GAMING</p>
                </div>
            </div>
        </div>
        
        <br><br>
        <h1>Fichiers : </h1>   
        <div class="affichage">
            <?php        
                $sql = "SELECT nom FROM Fichiers";
                $req = $conn->query($sql);
                if ($req->rowCount() > 0) {
                    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                        $nomFichier = $row["nom"];
                        echo '<div class="container">';
                        echo "<a href='telechargerCloud.php?nom=$nomFichier' download>$nomFichier</a><br>";
                        echo '</div>';
                        echo '<br>';
                    }
                }
                else {
                    echo "0 résultats";
                }

                $conn = null;
            ?>
        </div>

        
    </div>


<script src="fichiers.js"></script>
<script src="index.js"></script>
</body>
</html>