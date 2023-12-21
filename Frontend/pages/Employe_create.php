<?php
require_once('../../Backend/Employe.php');
require_once('../../Backend/Role.php');
require_once('../../backend/Utils.php');

function Form_Employe() {
    $BaseURL = GetBaseURL();
    $Roles = GetRoles();
    echo
    '<form action="' . $BaseURL . '" method="post" class="create_employee">
            <input type="text" class="form-control" placeholder="Nom (obligatoire)" name="Nom" id="Nom" required>
            <input type="text" class="form-control" placeholder="Prénom (obligatoire)" name="Prenom" id="Prenom" required>
            <select class="form-control" name="Role" id="Role">
                    <option value="0">Role</option>';
                        foreach($Roles as $role) {
                            echo '<option value="' . $role->idtypework . '">' . $role->name . '</option>';
                        }
                        echo
            '</select>
            <input type="password" class="form-control" placeholder="Mot de passe (obligatoire)" name="Password" id="Passsword" required>

            <input type="text" class="form-control" placeholder="Adresse mail" name="AdresseMail" id="AdresseMail">
            <input type="text" class="form-control" placeholder="Adresse postale" name="AdressePostale" id="AdressePostale">
            <input type="text" class="form-control" placeholder="Numéro de téléphone" name="Telephone" id="Telephone">
            <button class="btn btn-primary" type="submit" id="button-addon2">Ajouter</button>
    </form>';
    Add_Employe();
}


function Add_Employe() {
    if(isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Role']) && isset($_POST['Password'])) {
        $Nom = $_POST['Nom'];
        $Prenom = $_POST['Prenom'];
        $Role = $_POST['Role'];
        $Password = $_POST['Password'];
        $AdresseMail = $_POST['AdresseMail'];
        $AdressePostale = $_POST['AdressePostale'];
        $Telephone = $_POST['Telephone'];
        CreateEmploye($Nom , $Prenom , $AdresseMail, $AdressePostale, $Telephone , $Role, $TokenGoogleAgenda = null, $Password);
        echo '<script>window.location.href = "Employe.php?create_sucess=true";</script>';
    }
}

function Afficher_creer_employe(){
    Form_Employe();
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
            Afficher_creer_employe();
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

