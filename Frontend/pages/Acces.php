<?php
require_once('../../Backend/Acces.php');
require_once('../../Backend/Employe.php');
require_once('../../backend/Utils.php');

function Afficher_boutons() {
    $BaseURL = GetBaseURL();

    //Création d'un bouton pour le tri
    echo
    '<div class="row">
    <div class="row-left">
    <form action="' . $BaseURL . '" method="get">
        <div class="input-group ">
            <select class="form-select" name="sort" id="sort">
                <option value="Id">Trier par</option>
                <option value="Id">Id</option>
                <option value="IdEmploye">IdEmploye</option>
                <option value="DateTime">DateTime</option>
            </select>
            <button class="btn btn-primary" type="submit" id="button-addon2">Trier</button>
        </div>
    </form>';

    //Création d'un bouton pour supprimer les filtre
    echo
    '<a href="' . $BaseURL . '" class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i> Reinitialiser</a>
    </div>';

    //Création d'une recherche par employé avec un menu déroulant
    $Employes = GetEmployes();
    echo
        '<form action="' . $BaseURL . '" method="get" id="SearchByEmployee">
            <div class="input-group ">
                <select class="form-select" name="IdEmploye" id="IdEmploye">
                    <option value="0">Employé</option>';
    foreach($Employes as $row) {
        echo '<option value="' . $row->Id . '">' . $row->Nom . ' ' . $row->Prenom . '</option>';
    }
    echo
                '</select>
                <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
            </div>
        </form>
        </div>';
}

function Afficher_tableau_acces() {
    //Création du tableau des accès
    $sort = GetSort();
    if(isset($_GET['IdEmploye'])) {
        $IdEmploye = $_GET['IdEmploye'];
        if($IdEmploye != 0) {
            $Acces = GetAccesByIdEmploye($IdEmploye);
        }
        else {
            $Acces = GetAccesSort($sort);
        }
    }
    else {
        $Acces = GetAccesSort($sort);
    }

    echo 
    '<div class="tableContainer">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">IdEmploye</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
        <thead>
        <tbody class="table-group-divider">';

    foreach($Acces as $row) {
        $Date = date("d/m/Y", strtotime($row->DateTime));
        $Time = date("H:i:s", strtotime($row->DateTime));
        $Employe = GetEmployeById($row->IdEmploye);
        echo 
        '<tr>
            <td>' . $row->Id . '</td>
            <td>' . $row->IdEmploye . '</td>
            <td>' . $Employe[0]->Nom . '</td>
            <td>' . $Employe[0]->Prenom . '</td>
            <td>' . $Date . '</td>
            <td>' . $Time . '</td>
        </tr>';
    }
    echo 
    '</tbody>
    </table>
    <div class="tableContainer">';
}

function Afficher_Acces(){
    Afficher_boutons();
    Afficher_tableau_acces();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Bienvenue</title>
</head>
<?php
require_once('./sidebar.php');

$IDRole = $_SESSION['ROLE'];
$Role = GetRoleById($IDRole)[0]->name;

if ($Role != "admin") {
    header('Location: ' . $BaseURL . 'welcome.php');
}
?>
<body>

    <div class="container">
        <!-- Sidebar Section -->
        <?php Affiche_sidebar("Acces"); ?>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
        <?php
            Afficher_Acces(); 
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