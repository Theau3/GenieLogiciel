<?php
session_start();
require_once('../../backend/Role.php');
require_once('../../backend/Utils.php');



function Afficher_sidebar_admin($active){

    if($_SESSION == null){
        $BaseURL = GetBaseURL();
        header('Location: welcome.php');
    }
    
    $IDRole = $_SESSION['ROLE'];
    $Role = GetRoleById($IDRole)[0]->name;


    if ($Role == "admin") {
        return '
        <a href="http://localhost/GenieLogiciel/Frontend/pages/Acces.php" '.is_active($active,"Acces").'>
                <span class="material-icons-sharp">
                    sort
                </span>
                <h3>Accès</h3>
            </a>
            <a href="http://localhost/GenieLogiciel/Frontend/pages/Employe.php" '.is_active($active,"Employe").'>
                <span class="material-icons-sharp">
                    badge
                </span>
                <h3>Employés</h3>
            </a>
        ';
    }
}



function is_active($active, $page){
    if ($active == $page){
        return'class="active"';
    }
}

function Affiche_sidebar($active){
    echo '
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Sidebar Section -->
    <aside>
        <div class="toggle">
            <div class="logo">
                <img src="images/logo.png">
                <h2>CATY<span class="danger"> ERP</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">
                    close
                </span>
            </div>
        </div>

        <div class="sidebar">
        <a href="http://localhost/GenieLogiciel/Frontend/pages/Dashboard.php" '.is_active($active,"Dashboard").'>
            <span class="material-icons-sharp">
                dashboard
            </span>
        <h3>Dashboard</h3>
        </a>
        <a href="http://localhost/GenieLogiciel/Frontend/pages/schedule.php" '.is_active($active,"Schedule").'>
        <span class="material-symbols-outlined">
            calendar_month
        </span>
        <h3>EDT</h3>
        </a>
        <a href="http://localhost/GenieLogiciel/Frontend/pages/contacts.php"'.is_active($active,"Contact").'>
            <span class="material-icons-sharp">
                person_outline
            </span>
            <h3>Contacts</h3>
        </a>
        <a href="http://localhost/GenieLogiciel/Frontend/pages/fichiers.php"'.is_active($active,"Fichiers").'>
            <span class="material-symbols-outlined">
                smb_share
            </span>
            <h3>Fichiers</h3>
        </a>
        <a href="http://localhost/GenieLogiciel/Frontend/pages/Sales.php"'.is_active($active,"Ventes").'>
            <span class="material-icons-sharp">
                inventory
            </span>
            <h3>Ventes</h3>
        </a>

        '.Afficher_sidebar_admin($active).'    
        <a href="http://localhost/GenieLogiciel/Frontend/pages/logout.php">
            <span class="material-icons-sharp">
                logout
            </span>
        <h3>Déconnexion</h3>
        </a>
        </div>
    </aside>
    <!-- End of Sidebar Section -->';
    }
?>

