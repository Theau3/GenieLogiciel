<?php
require_once('../../backend/Role.php');

$IDRole = $_SESSION["ROLE"];
$Role = GetRoleById($IDRole)[0]->name;
?>

<!-- Nav Section -->

<div class="nav">
    <button id="menu-btn">
        <span class="material-icons-sharp">
            menu
        </span>
    </button>
    <div class="dark-mode">
        <span class="material-icons-sharp active">
            light_mode
        </span>
        <span class="material-icons-sharp">
            dark_mode
        </span>
    </div>

    <div class="profile">
        <div class="info">
            <p>Hey, <b><?php echo $_SESSION["PRENOM"] ?></b></p>
                <small class="text-muted"><?php echo $Role ?></b></small>
        </div>
    </div>
</div>
<!-- End of Nav -->
