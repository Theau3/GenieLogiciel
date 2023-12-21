<?php session_start(); // $_SESSION 
require_once('../../backend/ConnectToDb.php');
require_once('../../backend/Acces.php');
require_once('../../backend/Utils.php');
$pdo = ConnectToDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $username = $_POST['AdresseMail'];
    $password = $_POST['Password'];

// Validation du formulaire
if (isset($_POST['AdresseMail']) &&  isset($_POST['Password'])) {
    
    $query = valid_donnees($_POST['AdresseMail']);
    $sqlQuery = 'SELECT * FROM Employe WHERE AdresseMail = :query';
    $usersStatement = $pdo->prepare($sqlQuery);
    $usersStatement->execute(['query'=>$query]);
    $users = $usersStatement->fetchAll();

    if ($users != null){
        $user = $users[0];

    }
    $pw = $_POST['Password'];
        if (password_verify($pw, $user->Password))
         {
            $_SESSION['LOGGED_USER'] = $user->AdresseMail;
            $_SESSION['PRENOM'] = $user->Prenom;
            $_SESSION['ROLE'] = $user->IdRole;
            $_SESSION['ID'] = $user->Id;
            $_SESSION['message_bienvenue'] = 1;
            AddAcces($user->Id);
            header("Location: http://localhost/GenieLogiciel/Frontend/pages/Dashboard.php");
            exit();
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier pour cet utilisateur: (%s)',
                $_POST['AdresseMail'],
            );
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style_login.css">
    <!--<link rel="stylesheet" href="style.css"> !-->
    <title>Bienvenue</title>
</head>

<body>
    <div class="form-box">
		<div class="h1">
			Connectez-vous
		</div>
        </br>
            <!-- si message d'erreur on l'affiche -->
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
        <form action="login.php" method="POST">
        <input placeholder="Email@exemple.com" id="AdresseMail" name="AdresseMail" type="text">
        <input placeholder="Mot De Passe" id="Password" name="Password" type="password"> 
        <button type="submit" >Se connecter</button>
        </form>
    <div class="overlay-svg">
        <img src="images/logo.png"/>
    
    </div>
    </div>
    <div class="video-wrapper">
    <div class="ResponsiveYTPlayer">
        <iframe width="950" height="570" src="https://www.youtube.com/embed/VL1CHvsUSNo?rel=0&autoplay=1&mute=1" frameborder="0" allow= "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
