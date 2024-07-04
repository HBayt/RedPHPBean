<?php


// ORIGINAL CODE 


// Affichage des erreurs
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
*/ 


// TESTS 
// console.log("Message"); 
// console.log(variable); 
// var_dump(VARIABLE ); 
// var_dump("MESSAGE"); 
// echo "<h1> Hello world! from admin.php / vue partielle 3</h1>"; 

/* 
echo "<pre>";
// var_dump($_SESSION); // Affiche toutes les variables de session pour le debugging
echo "</pre>";
exit();

*/ 



session_start();

// if(! $_SESSION["login"]) { 
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
    // ______________________________________
    // ORIGINAL SERVEUR LINUX
    // ______________________________________
    // header("Location: /admin/"); // Original KO sur XAMPP 

    // ______________________________________
    // DEV LOCAL SERVEUR XAMPP 
    // ______________________________________

    // header("Location: http://localhost/admin/"); // KO  sur XAMPP 
     header("Location: /html/admin/"); // OK sur XAMPP | Firefox : http://localhost/html/admin/ 
      
    } 
    
