<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php';
include 'navbar.php';
include 'homepage.php';
include 'footer.php';
?>

