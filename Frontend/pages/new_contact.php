<?php require_once('../../backend/ConnectToDb.php'); ?>

<?php require_once('./sidebar.php');?>

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
   
            <div class ="class_h1"><h1 id="contact_name">Ajouter un contact</h1> </div>
            <div class="new_contact">
                <form action="form_new_contact.php" method="POST">
                  
                        <label for="name" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <br/>
                        <br/>
                   
                
                        <label for="surname" class="form-label">Prénom :</label>
                        <input type="text" class="form-control" id="surname" name="surname">
                        <br/>
                        <br/>
                  


                        <label for="telephone" class="form-label">Numéro de téléphone :</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                        <br/>
                        <br/>
                


              
                        <label for="email" class="form-label">Adresse mail :</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <br/>
                        <br/>
                   


               
                        <label for="address" class="form-label">Adresse postale :</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                        <br/>
                        <br/>

                        <label for="address" class="form-label">Domaine d'activité :</label>
                        <input type="text" class="form-control" id="activity" name="activity">
                        <br/>
                        <br/>
                  

                        <label for="communication" class="form-label">Préférence de communication (si vous préférez être contacté par téléphone, tapez téléphone svp) :</label>
                        <script>
                            var message = 'email';
                            document.write('<input type="text" class="communication" class="form-control" id="communication" name="communication" value="' + message + '" />');
                        </script>
                    
                
                    <button type="submit" class="btn-btn-primary">Envoyer</button>
                </form>
                <br />
    </div>
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

  </body>
  <script src="index.js"></script>
</html>