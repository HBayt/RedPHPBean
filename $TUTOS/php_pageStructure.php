<?php


// _______________________________________________
// FILE admin/admin.php  
// http://localhost/html/admin/admin.php 
// _______________________________________________


// TESTS 
// console.log("Message"); console.log(variable); 
// PHP INTERPRETER STOP TO EXECUTE CODE -> die(); 
// var_dump(VARIABLE ); 

// _______________________________________________
// CREATE SESSSION 
// _______________________________________________
session_start();


// _______________________________________________
// USER IS CONNECTED 
// _______________________________________________
if($_SESSION["login"]) {

    // REQUIRED & INCLUDED FILES 
    require '../config.php';
    require 'vue/partials/header.php';
    include '../utils/connectdb.php';
    require '../model/admin.php';
    include 'vue/partials/nav.php';
    
    // GET ALL ADMINISTRATORS SAVED IN DATABASE TABLE 'ADMIN'
    $admin = getAdmin();


    // CREATE BUTTON 
    // IF FORM 'CREATE' A NEW 'ADMIN CALLED (BUTTON CREATE)
    if(isset($_POST['name']) and isset($_POST['password'])){

        // INSERT INTO DATABASE TABLE 'ADMIN' A NEW 'ADMIN' ROW  
        createAdmin($_POST['name'], $_POST['password']);

        // REDIRECTION / REFRESH TIME
        header("Location: /html/admin/admin.php");  // header("Refresh:0"); 
    }

    // IF FORM 'DELETE' CURRENT ADMIN CALLED (BUTTON DELETE)
    if (isset($_POST['id_admin'])) {
        // GET ADMIN ID AND DELETE OCCURENCE (ROW) IN THE DATABASE TABLE 
        deleteAdmin($_POST['id_admin']);

        // REDIRECTION / REFRESH TIME
        header("Location: /html/admin/admin.php");  // header("Refresh:0");
    }


    // AFTER EACH PAGE CALL
    // OR 
    // AFTER THE EXECUTION OF AN INSTRUCTION ON THE PAGE (CREATE, DELETE) 
   
    include 'vue/admin.php';
    require 'vue/partials/footer.php';


} 
else {
    // _________________________________________________________________
    // ! $_SESSION["login"]
    // NO USER IS LOGGED IN TO THE TASK MANAGEMENT APPLICATION 
    // _________________________________________________________________


    // ______________________________________
    // ORIGINAL SERVEUR LINUX
    // header("Location: /admin/"); 

    // THIS INSTRUCTION/COMMAND IS KO ON XAMPP BECAUSE TASK MANAGEMENT CODE IS IN A FOLDER NAMED 'html' 
    // ______________________________________


    // ______________________________________
    // DEV LOCAL SERVEUR XAMPP 
    // ______________________________________
     header("Location: /html/admin/"); // OK sur XAMPP -> Firefox : http://localhost/html/admin/ 
      
    } 
    
