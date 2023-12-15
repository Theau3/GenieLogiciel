<?php

function is_active($active, $page){
    if ($active == $page){
        return'class="active"';
    }
}

function Affiche_sidebar($active){
    echo '
    <!-- Sidebar Section -->
    <aside>
        <div class="toggle">
            <div class="logo">
                <img src="images/logo_caty_sansnom.png">
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">
                    close
                </span>
            </div>
        </div>

        <div class="sidebar">
            <a href="index.php" class="active">
                <span class="material-icons-sharp">
                    dashboard
                </span>
                <h3>Dashboard</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">
                    person_outline
                </span>
                <h3>Contacts</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">
                    insights
                </span>
                <h3>Données</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">
                    mail_outline
                </span>
                <h3>Messages</h3>
                <span class="message-count">27</span>
            </a>
            <a href="fichiers.php">
                <span class="material-symbols-outlined">
                    smb_share
                </span>
                <h3>Fichiers</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">
                    inventory
                </span>
                <h3>Ventes</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">
                    report_gmailerrorred
                </span>
                <h3>Reports</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">
                    settings
                </span>
                <h3>Paramètres</h3>
            </a>
            <a href="login.php">
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