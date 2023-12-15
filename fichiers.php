<?php include_once('mysql.php'); 
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
        <?php Affiche_sidebar("Employe"); ?>

        
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
                    <!-- <li class="in-prog">
                        <div class="col">
                            <img src="icons/image.png" alt="image">
                        </div>
                        <div class="col">
                            <div class="file-name">
                                <div class="name">Nom du fichier</div>
                                <span>50%</span>
                            </div>
                            <div class="file-progress">
                                <span></span>
                            </div>
                            <div class="file-size">2.2 MB</div>
                        </div>
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" class="cross" height="20" width="20"><path d="m5.979 14.917-.854-.896 4-4.021-4-4.062.854-.896 4.042 4.062 4-4.062.854.8"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="tick" height="20" width="20"><path d="m8.229 14.438-3.896-3.917 1.438-1.438 2.458 2.459 6-6L15.667 7Z"/></svg>
                            </div>
                        </div>
                    </li> -->
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
</body>
</html>