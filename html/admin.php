<?php
session_start();



// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirection de test
// header("Location: https://www.google.com"); // OK 
echo "<h1> Hello world! from admin.php / vue partielle header </h1>"; 



// var_dump($_SESSION); // Affiche toutes les variables de session pour le debugging
var_dump( header("Location: http://localhost/admin/")); // Affiche toutes les variables de session pour le debugging

// Warning:  Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\html\admin\vue\partials\nav.php:1) in C:\xampp\htdocs\html\admin\admin.php on line 27



exit();
?>


<?php 
/* 
<?php

session_start();

if($_SESSION["login"]) {
    require '../config.php';
    require 'vue/partials/header.php';
    include '../utils/connectdb.php';
    require '../model/admin.php';
    include 'vue/partials/nav.php';
    
    $admin = getAdmin();

    if(isset($_POST['name']) and isset($_POST['password'])){
        createAdmin($_POST['name'], $_POST['password']);
        header("Refresh:0");
    }
    if (isset($_POST['id_admin'])) {
        deleteAdmin($_POST['id_admin']);
        header("Refresh:0");
    }
   
    include 'vue/admin.php';
    require 'vue/partials/footer.php';
} else {
    header("Location: /admin/");
} 


*/ 
?> 