<?php
require_once('../../backend/ConnectToDb.php');
require_once('./sidebar.php');
require_once("./post_shedule.php");

function Affiche_formulaire(){
    echo '<form method="post">
        <h2>Ajouter un événement</h2>

        <label for="nom">Nom de l\'événement :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required>

        <label for="heure">Heure :</label>
        <input type="text" id="heure" name="heure" required>

        <label for="type_evenement">Type d\'événement :</label>
        <select id="type_evenement" name="type_evenement" required>
            <option value="Reunion">Réunion</option>
            <option value="Formation">Formation</option>
            <option value="Stage">Stage</option>
        </select>

        <button type="submit">Ajouter l\'événement</button>
    </form>';
}

function getDaysOfWeek($currentDate) {
    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $currentDayOfWeek = date("l", strtotime($currentDate)); // 0 (for Monday) to 6 (for Sunday)
    $currentDayIndex = array_search($currentDayOfWeek, $daysOfWeek);

    $weekDays = [];
    for ($i = 0; $i < 7; $i++) {
        $dayIndex = ($currentDayIndex + $i) % 7;
        $weekDays[] = $daysOfWeek[$dayIndex];
    }

    return $weekDays;
}
function getDates($startDate) {
    $dates = [];
    $currentDate = date('Y-m-d', strtotime($startDate));

    for ($i = 0; $i < 7; $i++) {
        $dates[] = $currentDate;
        $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }

    return $dates;
}


function Affiche_schedule(){
    Affiche_formulaire();
    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    //$currentDate = date('2023-12-22');
    $currentDate = date('Y-m-d');

    $currentDayOfWeek = date("l", strtotime($currentDate)); // 0 (for Monday) to 6 (for Sunday)

    echo '<div class="schedule">';

    $currentweek = getDaysOfWeek($currentDate);
    $datew = getDates($currentDate);

    $schedule = getScheduleFromDatabase($datew[0]);
    for ($i = 1; $i <= 7; $i++) {
        // Utilisez le jour actuel + décalage pour afficher les jours à partir de lundi (1 correspond à lundi)
        
       
        
        // $dateToDisplay = date('Y-m-d', strtotime($currentDate . " +$i days"));
        // $currentDayOfWeek = (new DateTime($dateToDisplay))->format('w');

        // $dayIndex = ($currentDayOfWeek + $i) % 7;
        $day = $currentweek[$i - 1];
    

        //$schedule = getScheduleFromDatabase($datew[$i-1]);

        

        echo '<div class="day">';
        
        echo '<h2>'.$day.'</h2>';

        // Vérifiez si des événements existent pour ce jour
        if (isset($schedule[$day])) {
            $events = $schedule[$day];

            // Triez les événements par heure
            ksort($events);

            foreach ($events as $time => $event) {

                // Vérifiez si la date de l'événement est comprise entre le vendredi 22 décembre et le jeudi 28 décembre
                //if ($currentDate >= '2023-12-22' && $currentDate <= '2023-12-28') {
                    echo "<div class='time-slot'>$time : $event</div>";
                //}
            }
        }

        echo '</div>';

        // Mettez à jour la date actuelle pour passer au jour suivant
        //$currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }
    echo '</div>';
}
    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style_schedule.css">
    <title>EDT</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <?php Affiche_sidebar("Schedule") ?>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <?php
            Affiche_schedule()
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


