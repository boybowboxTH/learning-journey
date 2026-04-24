<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php';
include 'navbar.php';
include 'dentistuser_details.php';
?>

