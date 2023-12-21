<?php
require_once('../../backend/ConnectToDb.php');
require_once('../../backend/Utils.php');
ini_set('display_errors', '0'); 
?>

<?php require_once('./sidebar.php');
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP - Formulaire d'ajout d'un contact</title>
     <!--fichier css-->
   <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
   <!--fichier css-->
   <link rel="stylesheet" href="style_contacts.css?v=<?php echo time();?>">

   <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   
</head>


<body>
    <div class="container">
    <?php Affiche_sidebar("Contact"); ?>
    
    <div class ="class_h1"><h1 id="contact_name">CONTACTS</h1></div>
    <div class="class_new_contact"><a href="new_contact.php">Ajout contact</a> </div>
    <?php
        $pdo = ConnectToDb();
        $reponse = $pdo->query('SELECT * FROM contacts');
        $rep = $pdo->query('SELECT * FROM contacts WHERE idWorker=1');
    ?>

    <?php
        $donnees = $reponse->fetch();
        $donnees_id_un = $rep->fetch();

        // On utilise la fonctions valid_donnees() pour éviter l'affichage de code par hyperlien
        $donnees_id_un_idContact = valid_donnees($donnees_id_un->idWorker);
        $donnees_id_un_name = valid_donnees($donnees_id_un->name);
        $donnees_id_un_surname = valid_donnees($donnees_id_un->surname); 
        $donnees_id_un_telephone = valid_donnees($donnees_id_un->telephone);
        $donnees_id_un_email = valid_donnees($donnees_id_un->email);
        $donnees_id_un_address = valid_donnees($donnees_id_un->address);
        $donnees_id_un_activity = valid_donnees($donnees_id_un->activity);
        $donnees_id_communication = valid_donnees($donnees_id_un->communication);

        if($donnees_id_communication == '1'){
            $aff_comm_un = "telephone";
            
            }
        else{
            $aff_comm_un = "email";
            
        }?>

      
        <div class="_contact">
            <label><b>Nom</b> : <?php echo $donnees_id_un_name ?></label>
            <br/>

            <label><b>Prénom</b> : <?php echo $donnees_id_un_surname ?></label>
            <br/>
            <label><b>Numéro de téléphone</b> : <?php echo $donnees_id_un_telephone ?></label>
            <br/>
            <label><b>Adresse mail</b> : <?php echo $donnees_id_un_email ?></label>

            <br/>
            <label><b>Adresse</b>: <?php echo $donnees_id_un_address ?></label>

            <br/>
            <label><b>Domaine d'activité</b> : <?php echo $donnees_id_un_activity ?></label>

            <br/>
            <label><b>Préférence de communication</b> : <?php echo $aff_comm_un ?></label>
            

             
    
    <?php $id =2;?>
   
   
    <?php while ($donnees = $reponse->fetch()){ 
            
            $id_contact = valid_donnees($donnees->idworker);
            $name = valid_donnees($donnees->name);
            $surname = valid_donnees($donnees->surname); 
            $telephone = valid_donnees($donnees->telephone);
            $email = valid_donnees($donnees->email);
            $address = valid_donnees($donnees->address);
            $activity = valid_donnees($donnees->activity);
            $communication = valid_donnees($donnees->communication);

            if($communication == '1'){
                $aff_comm = "telephone";
                
                }
            else{
                $aff_comm = "email";
                
            }?>

        <br/>
        <br/>
        <br/>
            <label><b>Nom</b> : <?php echo $name ?></label>
            <br/>
            <label><b>Prénom</b> : <?php echo $surname ?></label>
            <br/>
            <label><b>Numéro de téléphone</b> : <?php echo $telephone ?></label>
            <br/>
            <label><b>Adresse mail</b> : <?php echo $email ?></label>
            <br/>
            <label><b>Adresse</b> : <?php echo $address ?></label>
            <br/>
            <label><b>Domaine d'activité</b> : <?php echo $activity ?></label>
            <br/>
            <label><b>Préférence de communication</b> : <?php echo $aff_comm?></label>
            </div>
            
   <?php ++$id;     
    
}
    $reponse->closeCursor(); // Termine le traitement de la requête
    $rep->closeCursor();
?>

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
</body>
</div>
<script src="index.js"></script>
</html>


