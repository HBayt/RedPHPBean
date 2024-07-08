<?php
session_start();


// Affichage des erreurs
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo "<h1> Hello world! from admin.php / vue partielle header </h1>"; 
var_dump($_SESSION); // Affiche toutes les variables de session pour le debugging
var_dump( header("Location: http://localhost/admin/")); // Affiche toutes les variables de session pour le debugging

¨
exit();
*/ 


// Erreur Corrigée : 
// Warning:  Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\html\admin\vue\partials\nav.php:1) in C:\xampp\htdocs\html\admin\admin.php on line 27



?>


