<!DOCTYPE html>
<?php 
require_once('../../backend/ConnectToDb.php');

ini_set('display_errors','1');
$conn = ConnectToDb();
?>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>

</head>



<body>

    <div class="container"> 

        <!-- Sidebar Section -->
        <?php
        require_once('./sidebar.php');
        Affiche_sidebar("Dashboard");
        ?>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Tableau de bord</h1>
            <!-- résumés -->
            <div class="analyse">
                <?php    
                    $sql = "SELECT * FROM Ventes";
                    $req = $conn->query($sql);
                    $vente = 0 ;
                    $qtvente = 0;
                    while ($row = $req->fetch(PDO::FETCH_ASSOC))
                    {
                        $vente = $row["SalesFigures"] + $vente;
                        $qtvente = $row["QtSales"] + $qtvente;

                    };
                ?>
                <div class="sales"  onclick="javascript:window.location='http://localhost/GenieLogiciel/Frontend/pages/Sales.php';">
                    <div class="status">
                        <div class="info">
                            <h3>Ventes totales dernier mois</h3>
                            <h1>
                                <?php
                                echo"$qtvente";
                                ?>
                            </h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="visits"  onclick="javascript:window.location='http://localhost/GenieLogiciel/Frontend/pages/Sales.php';">
                    <div class="status">
                        <div class="info">
                            <h3>chiffre d'affaire dernier mois</h3> 
                            <h1>
                            <?php
                                echo"$vente €";
                                ?>
                            </h1>               
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>
                                    <?php
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h1>Prochaine tâche</h1>

                            <!--debut list-->

                            <div class="right-section">
                                <div class="reminders" onclick="javascript:window.location='#';" >
                                    <div class="notification deactive">
                                        <div class="icon">
                                            <span class="material-icons-sharp">
                                                edit
                                            </span>
                                        </div>
                                        <div class="content">
                                            <div class="info">
                                            <h3>
                                            Programmation de l'interface utilisateur
                                            </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--fin list-->
                        </div>
                    </div>
                </div>
            <!-- End of Analyses -->


            
            <!-- New Users Section -->
            
            <div class="new-users">
                <h2>Contacts</h2>
                <div class="user-list">
                <?php    
                    $sql = "SELECT * FROM Employe";
                    $req = $conn->query($sql);
                    if ($req->rowCount() > 0) 
                    {
                        $r = 0;
                        while (($row = $req->fetch(PDO::FETCH_ASSOC)) && $r < 5) 
                        {
                            $Nom = $row["Nom"];
                            $Prenom = $row["Prenom"];
                            $r = $r +1;
                            echo "
                            <div class='user'>
                            <img src='images/profile-1.jpg'>
                            <h2>$Nom</h2>
                            <h2>$Prenom</h2>
                            </div>
                            <div class='reminders' >
                            <div class='header'>
                            </div>
                            </div>"

                        ;
                        }
                    }

                    ?>
                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- EdT -->
            <div class="recent-orders">
                <h2>Emploi du temps pour la journée</h2>

            </div>
            <!-- End EdT -->

            <!-- Document -->
            <div class="recent-orders" onclick="javascript:window.location='http://localhost/GenieLogiciel/Frontend/pages/fichiers.php';">
                <h2>Mes documents les plus récents</h2>

                <!--debut list-->
                                            
                <div class="right-section">

                    <?php    
                    $sql = "SELECT nom FROM Fichiers";
                    $req = $conn->query($sql);
                    if ($req->rowCount() > 0) 
                    {
                        $r = 0;
                        while (($row = $req->fetch(PDO::FETCH_ASSOC)) && $r < 3) 
                        {
                            $nomFichier = $row["nom"];
                            $r = $r +1;
                            echo "
                            <div class='reminders' >
                            <div class='header'>
                            </div>
                            <div class='notification deactive'>
                                <div class='content'>
                                    <div class='info'>
                                    <h3>$nomFichier</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                    }

                    ?>
                    
                <!--fin list-->

            </div>
            <!-- End Document -->

        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            
            <?php include('header.php'); ?>
            <!-- End of Nav -->

            <div class="reminders">
                <div class="header">
                    <h2>Notifications</h2>
                </div>
                
                <?php    
                    $sql = "SELECT * FROM events";
                    $req = $conn->query($sql);
                    if ($req->rowCount() > 0) 
                    {
                        $r = 0;
                        while (($row = $req->fetch(PDO::FETCH_ASSOC)) && $r < 2) 
                        {
                            $nomevent = $row["Nom"];
                            $date = $row["Date"];
                            $heure = $row["Heure"];
                            $r = $r +1;
                            echo "
                            <div class='reminders' >
                            <div class='header'>
                            </div>
                            <div class='notification deactive'>
                                <div class='content'>
                                    <div class='info'>
                                    <h3>$nomevent</h3>
                                    <h5>$date</h5>
                                    <h5>$heure</h5>
                                    </div>
                                </div>
                            </div>
                        </div>"

                        ;
                        }
                    }

                    ?>

            </div>


            <div class="reminders">
                <div class="header">
                    <h2>Réunion à venir</h2>
                </div>

                <?php 
                
                $sql = "SELECT * FROM events WHERE TypeEvenement='Reunion'";
                    $req = $conn->query($sql);
                    if ($req->rowCount() > 0) 
                    {
                        $r = 0;
                        while (($row = $req->fetch(PDO::FETCH_ASSOC)) && $r < 2) 
                        {
                            $nomevent = $row["Nom"];
                            $date = $row["Date"];
                            $heure = $row["Heure"];
                            $r = $r +1;
                            echo "
                            <div class='reminders' >
                            <div class='header'>
                            </div>
                            <div class='notification deactive'>
                                <div class='content'>
                                    <div class='info'>
                                    <h3>$nomevent</h3>
                                    <h5>$date</h5>
                                    <h5>$heure</h5>
                                    </div>
                                </div>
                            </div>
                        </div>"

                        ;
                        }
                    }
                ?>

                
            </div>

        </div>


    </div>

    <script src="index.js"></script>
</body>

</html>


<?php
$conn = null;
?>