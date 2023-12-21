<?php
require_once('../../backend/ConnectToDb.php');
require_once('../../backend/Utils.php');
ini_set('display_errors', '0'); //ne pas afficher les erreurs si les informations incorrectes sont entrées
?>
<?php require_once('./sidebar.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP - Formulaire reçu</title>
     <!--fichier css-->
   <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
   <!--fichier css-->
   <link rel="stylesheet" href="style_contacts.css?v=<?php echo time();?>">
    <!--JQUERY-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js%22%3E"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
<script src="index.js"></script>

<div class="container">
    



        <?php Affiche_sidebar("Contact"); ?>
        
    
         
        <?php  
            $name = valid_donnees($_POST['name']);
            $surname = valid_donnees($_POST['surname']);
            $telephone = valid_donnees($_POST['telephone']);
            $email = valid_donnees($_POST['email']);
            $address = valid_donnees($_POST['address']);
            $activity = valid_donnees($_POST['activity']);
            $communication = valid_donnees($_POST['communication']);

            $pdo = ConnectToDb();

            if (empty($name) || empty($surname) || empty($telephone) || empty($email) || empty($address)|| empty($activity)) { ?>	
                <div class ="class_h2"><h2><?php echo('Il faut remplir tous les champs pour soumettre le formulaire.')?></h2></div>
                <?php return;
            }
            //recherche id contact
            $id_cont = $pdo->query("SELECT * FROM contacts WHERE name LIKE '%$name%'");
            $id_cont->execute();
            $id_contacts = $id_cont->fetch(); 
            if($id_contacts->name == $name){ //si le contact fait partie de la bdd ?> 
    	        <div class ="class_h2"><h2><?php echo("Le contact existe déjà")?></h2></div>
                 <?php return;
            }
            $id_cont->closeCursor();
            $count = $pdo->query('SELECT COUNT(*) AS nb FROM contacts');
            $count->execute();
            $data = $count->fetch(); 
        
            //test du numéro de téléphone
            if(strlen($telephone) != 10){
                ?><div class ="class_h2"><h2><?php echo("La syntaxe du numéro de téléphone entré n'est pas valide")?></h2></div>
                <?php return;
            } 
            //si le numéro contient des lettres
            if (!ctype_digit($telephone)) {
                ?><div class ="class_h2"><h2><?php echo("Le numéro de téléphone contient des lettres")?></h2></div> 
                <?php return;
            }

              
            if($communication == 'téléphone' || $communication == 'telephone'){
                $typecomm = "Vous préférez être contacté par téléphone";
                $comm = '1';
            }
            else{
                $typecomm = "Vous préférez être contacté par email";
                $comm = '0';
            }
            
            
            
                try { 
                    $pdo->beginTransaction(); // commencer les instructions qui seront envoyées seulement si on ne détecte pas d'erreur
                    $sql = "INSERT INTO `contacts` (`idworker`,`name`, `surname`,`telephone`,`email`, `address`,`activity`, `communication`) VALUES (:idworker,:name, :surname ,:telephone, :email, :address , :activity, :communication)";
                    $res = $pdo->prepare($sql);
                    $exec = $res->execute(array(":idworker"=>($data->nb+1), ":name"=>$name, ":surname"=>$surname, ":telephone"=>$telephone, ":email"=>$email , ":address"=>$address , ":activity"=>$activity , ":communication"=>$comm));
                    $pdo->commit();
                }
                catch(PDOException $e) {
                    $pdo->rollBack(); // s'il y a une erreur, les données ne seront pas envoyées dans la bdd
                    echo "Erreur : " . $e->getMessage();
                } 
                
                
               
                ?>




<div class ="class_h2"><h1>Bienvenue à <?php echo($surname); ?> </b><?php echo($name);?></h1></div>


</body>
</html>