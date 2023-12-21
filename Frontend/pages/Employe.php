<?php

require_once('../../Backend/Employe.php');
require_once('../../Backend/Role.php');
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
                <option value="Id">Id</option>
                <option value="Nom">Nom</option>
                <option value="Prenom">Prénom</option>
                <option value="IdRole">Role</option>
            </select>
            <button class="btn btn-primary" type="submit" id="button-addon2">Trier</button>
        </div>
    </form>';

    //Création d'un bouton pour supprimer les filtre
    echo
    '<a href="' . $BaseURL . '" class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i> Reinitialiser</a>
    </div>';

    //Création d'un bouton pour créer un employé
    echo
    '<div class="row-right">
        <a href="' . str_replace("Employe.php","Employe_create.php",$BaseURL) . '" class="btn btn-primary"><i class="fa-regular fa-plus"></i> Ajouter un employé</a>
    </div>';

    //Création d'une recherche par Role avec un menu déroulant
    $Roles = GetRoles();
    echo
        '<form action="' . $BaseURL . '" method="get" id="SearchByRole">
            <div class="input-group ">
                <select class="form-select" name="Role" id="Role">
                    <option value="0">Role</option>';
    foreach($Roles as $role) {
        echo '<option value="' . $role->idtypework . '">' . $role->name . '</option>';
    }
    echo
                '</select>
                <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
            </div>
        </form>
        </div>';
}

function Afficher_tableau_employes(){
    $sort = GetSort();
    $BaseURL = GetBaseURL();
    if(isset($_GET['Role'])) {
        $Role = $_GET['Role'];
        if($Role != 0) {
            $Employes = GetEmployesByRole($Role);
        }
        else {
            $Employes = GetEmployesSort($sort);
        }
    }
    else {
        $Employes = GetEmployesSort($sort);
    }

    echo '
    <div class="tableContainer">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Adresse mail</th>
                    <th scope="col">Adresse postale</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Role</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">';

    foreach($Employes as $Employe) {
        $role = GetRoleById($Employe->IdRole);
        echo 
        '<tr>
            <td>' . $Employe->Id . '</td>
            <td>' . $Employe->Nom . '</td>
            <td>' . $Employe->Prenom . '</td>
            <td> <a href="mailto: '.$Employe->AdresseMail.'">' . $Employe->AdresseMail . '</a></td>
            <td><a href="https://www.google.fr/maps/place/'.str_replace(" ","+",$Employe->AdressePostale).'" target="_blank">' . $Employe->AdressePostale . '</a></td>
            <td> <a href="tel: '.$Employe->Telephone.'">' . $Employe->Telephone . '</a></td>
            <td>' . $role[0]->name . '</td>
            <td>
                <a href="' . str_replace("Employe.php","Employe_edit.php",$BaseURL) . '?id='.$Employe->Id.'" class="btn btn-success edit_employee_button">
                <span class="material-icons-sharp">
                    edit
                </span>
                </a>
        </tr>';
    }

    echo 
    '</tbody>
    </table>
    <div class="tableContainer">';
}

function Message_confirmation(){
    if(isset($_GET['edit_sucess']) && $_GET['edit_sucess'] == true)
        echo '<div class="alert alert-success" role="alert">
            Employé modifié avec succès !
        </div>';
    if(isset($_GET['create_sucess']) && $_GET['create_sucess'] == true)
        echo '<div class="alert alert-success" role="alert">
            Employé créé avec succès !
        </div>';
    if(isset($_GET['delete_sucess']) && $_GET['delete_sucess'] == true)
        echo '<div class="alert alert-success" role="alert">
            Employé supprimé avec succès !
        </div>';

        
}

function Afficher_Employes(){
    Afficher_boutons_employes();
    Afficher_tableau_employes();
    Message_confirmation();
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
        <?php Affiche_sidebar("Employe"); ?>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
        <?php
            Afficher_Employes();
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