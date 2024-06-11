<?php
session_start();



// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirection de test
// header("Location: https://www.google.com"); // OK 
echo "<h1> Hello world! from admin.php </h1>"; 

echo "<pre>";
var_dump($_SESSION); // Affiche toutes les variables de session pour le debugging
echo "</pre>";

exit();
?>