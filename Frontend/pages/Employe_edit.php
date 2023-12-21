<?php

require_once('../../Backend/Employe.php');
require_once('../../Backend/Role.php');
require_once('../../backend/Utils.php');

function GetId(){
    $id = $_GET['id'];
    return $id;
}

function Form_edit_employe(){
    $BaseURL = GetBaseURL();
    $Id = GetId();

    $Employe = GetEmployeById($Id);

    $Roles = GetRoles();
    $Role = GetRoleById($Employe[0]->IdRole);

    echo
    '<a href="' .$BaseURL. '?id='.$Id.'&amp;delete=true" class="btn btn-danger ">
        <span class="material-icons-sharp">
            delete
        </span>
        Supprimer
    </a>
    <form action="' . $BaseURL . '?id='.$Id.'" method="post" class="edit_employee">
            <input type="text" class="form-control" placeholder="Nom" name="Nom" value="'.$Employe[0]->Nom.'" id="Nom">
            <input type="text" class="form-control" placeholder="Prénom" name="Prenom" value="'.$Employe[0]->Prenom.'" id="Prenom">
            <select class="form-control" name="Role" id="Role">
                    <option value="'.$Role[0]->idtypework.'">'.$Role[0]->name.'</option>';
                        foreach($Roles as $role) {
                            echo '<option value="' . $role->idtypework . '">' . $role->name . '</option>';
                        }
                        echo
            '</select>
            <input type="password" class="form-control" placeholder="Mot de passe" name="Password" id="Passsword">

            <input type="text" class="form-control" placeholder="Adresse mail" name="AdresseMail" value="'.$Employe[0]->AdresseMail.'" id="AdresseMail">
            <input type="text" class="form-control" placeholder="Adresse postale" name="AdressePostale" value="'.$Employe[0]->AdressePostale.'" id="AdressePostale">
            <input type="text" class="form-control" placeholder="Numéro de téléphone" name="Telephone" value="'.$Employe[0]->Telephone.'" id="Telephone">
            <button class="btn btn-primary" type="submit" id="button-addon2">Modifier</button>
    </form>';
    MAJ_Employe();
    Delete_Employe();
}

function MAJ_Employe() {
    $Id = GetId();
    if(isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Role']) && isset($_POST['Password'])) {
        $Nom = $_POST['Nom'];
        $Prenom = $_POST['Prenom'];
        $Role = $_POST['Role'];
        $Password = $_POST['Password'];
        $AdresseMail = $_POST['AdresseMail'];
        $AdressePostale = $_POST['AdressePostale'];
        $Telephone = $_POST['Telephone'];
        UpdateEmploye($Id, $Nom , $Prenom , $AdresseMail, $AdressePostale, $Telephone , $Role, $TokenGoogleAgenda = null, $Password);
        echo '<script>window.location.href = "Employe.php?edit_sucess=true";</script>';
    }
}

function Delete_Employe() {
    if(isset($_GET['id']) && isset($_GET['delete']) && $_GET['delete'] == true) {
        $Id = GetId();
        DeleteEmploye($Id);
        echo '<script>window.location.href = "Employe.php?delete_sucess=true";</script>';
    }
}

function Afficher_modifier_employe(){
    Form_edit_employe();
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
            Afficher_modifier_employe();
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