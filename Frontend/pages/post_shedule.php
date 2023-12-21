<?php

$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// Function to get the schedule from the database based on the date
function getScheduleFromDatabase($date) {
    $pdo = connectToDb();

    $query = $pdo->prepare("SELECT * FROM events WHERE YEARWEEK(Date) = YEARWEEK(:date)");
    $query->bindParam(':date', $date);
    $query->execute();

    $schedule = [];

    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
        $time = $row->Heure;
        $event = $row->TypeEvenement;
        $nom = $row->Nom;

        $dateTime = new DateTime($row->Date);
        $day = $dateTime->format('l');

        $schedule[$day][$time] =  $event;
    }

    return $schedule;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDate = $_POST['date'];
    $typeEvenement = $_POST['type_evenement'];
    $heure = $_POST['heure'];
    $nom = $_POST['nom'];

    if (!empty($selectedDate) && !empty($typeEvenement) && !empty($heure) && !empty($nom)) {
        $currentDate = date('Y-m-d', strtotime($selectedDate));

        $pdo = connectToDb();

        $query = $pdo->prepare("INSERT INTO events (Date, Heure, TypeEvenement, Nom) VALUES (:date, :heure, :type_evenement, :nom)");
        $query->bindParam(':date', $currentDate);
        $query->bindParam(':heure', $heure);
        $query->bindParam(':type_evenement', $typeEvenement);
        $query->bindParam(':nom', $nom);
        $query->execute();
    }
    // Redirect to the same page to avoid resubmitting the form when refreshing the page
    header('Location: ' . $_SERVER['REQUEST_URI']);
}

// Check if the form has been submitted before calling the function to get the schedule
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $schedule = getScheduleFromDatabase(date('Y-m-d'));
}

?>