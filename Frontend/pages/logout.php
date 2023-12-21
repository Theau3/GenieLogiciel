<?php session_start(); ?>

<?php
    if (session_destroy()) {
        header("Location: login.php");
    }
?>