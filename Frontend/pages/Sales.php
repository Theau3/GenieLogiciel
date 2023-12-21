<?php
    require_once('../../backend/Sales.php');
    require_once('./sidebar.php');
    require_once('../../backend/Utils.php');
    function Afficher_boutons_employes() {
        $BaseURL = GetBaseURL();
    
        //Création d'un bouton pour le tri
        echo
        '<div class="row">
            <div class="row-left">
                <form action="' . $BaseURL . '" method="get">
                    <div class="input-group ">
                        <select class="form-select" name="sort" id="sort">
                            <option value="0">Trier par</option>
                            <option value="IdSales">Id</option>
                            <option value="GameID">Nom</option>
                            <option value="SupportID">Plateforme</option>
                            <option value="SalesFigures">Chiffre d\'affaire</option>
                        </select>
                        <button class="btn btn-primary" type="submit" id="button-addon2">Trier</button>
                    </div>
                </form>';
            //Création d'un bouton pour supprimer les filtre
    echo
                '<a href="' . $BaseURL . '" class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i> Reinitialiser</a>
            </div>';


    //Création d'une recherche par Role avec un menu déroulant
    $Supports = GetGameSupport();
    $Games = GetGameName();
    echo
        '<div class="row-right">
            <form action="' . $BaseURL . '" method="get" id="SearchByGame">
                <div class="input-group ">
                    <select class="form-select" name="Game" id="Game">
                        <option value="0">Jeu</option>';
    foreach($Games as $Game) {
        echo '          <option value="' . $Game->GameID . '">' . $Game->Name . '</option>';
    }
    echo
                '   </select>
                    <select class="form-select" name="Support" id="Support">
                        <option value="0">Support</option>';
                        foreach($Supports as $Support) {
                            echo '<option value="' . $Support->SupportID . '">' . $Support->Names . '</option>';
                        }
    echo'
                    </select>
                    <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
                </div>
            </form>
        </div>';
         
    echo '</div>';
    }

    function Afficher_tableau_ventes(){
        $Sales = GetSales();
        if(isset($_GET['Game'])){
            $GameName = $_GET['Game']; 
        }
        else {
            $GameName = 0;
        }
        if(isset($_GET['Support'])){
            $SupportIDD = $_GET['Support'];
        }
        else {
            $SupportIDD = 0;
        }
        if(isset($_GET['sort'])){
            $Sort = $_GET['sort'];
        }
        else {
            $Sort = null;
        }
            if($SupportIDD != 0 && $GameName != 0 && $Sort != null) {
                $Sales = GetSalesByGameNameSupportSort($GameName, $SupportIDD);
            }
            elseif($GameName != 0 && $SupportIDD != 0 && $Sort == null) {
                $Sales = GetSalesByGameAndSupport($GameName, $SupportIDD);
            }
            elseif($GameName != 0 && $SupportIDD == 0 && $Sort != null) {
                $Sales = GetSalesByGameNameSort($SupportIDD, $Sort);
            }
            elseif($GameName == 0 && $SupportIDD != 0 && $Sort != null) {
                $Sales = GetSalesBySupportSort($SupportIDD,$Sort);
            }
            elseif($GameName != 0 && $SupportIDD == 0 && $Sort == null) {
                $Sales = GetSalesByGame($GameName);
            }
            elseif($GameName == 0 && $SupportIDD != 0 && $Sort == null) {
                $Sales = GetSalesBySupport($SupportIDD);
            }
            elseif($GameName == 0 && $SupportIDD == 0 && $Sort != null) {
                $Sales = GetSalesSort($Sort);
            }
            elseif($GameName == 0 && $SupportIDD == 0 && $Sort == null) {
                $Sales = GetSales();
            }

    
    if($Sales == null){
        echo '<div class="alert alert-danger" role="alert">
        Aucune vente n a été trouvée
        </div>';
    }
    else {
        echo '
        <div class="tableContainer">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Jeu</th>
                        <th scope="col">Support</th>
                        <th scope="col">Chiffre d Affaires</th>
                        <th scope="col">Nombre de Ventes</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">';
    
        foreach($Sales as $Sale) {
            $Support = GetSupportById($Sale->SupportID);
            $Game = GetGameByID($Sale->GameID);
            echo 
            '<tr>
                <td>' . $Sale->IdSales . '</td>
                <td>' . $Game[0]->Name . '</td>
                <td>' . $Support[0]->Names . '</td>
                <td>' . $Sale->SalesFigures . ' €</td>
                <td>' . $Sale->QtSales . '</td>
            </tr>';
        }
    
        echo 
        '</tbody>
        </table>
        <div class="tableContainer">';
        }
    }


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Ventes</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <?php Affiche_sidebar("Ventes") ?>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <?php
            Afficher_boutons_employes();
            Afficher_tableau_ventes();
            ?>
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
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


    </div>

    <script src="index.js"></script>
</body>

</html>