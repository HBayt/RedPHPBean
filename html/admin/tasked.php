<?php

session_start();

if($_SESSION["login"]) {
    require '../config.php';
    require 'vue/partials/header.php';
    include '../utils/connectdb.php';
    include '../model/tasked.php';
    include '../model/user.php';
    include 'vue/partials/nav.php';


    $taskeds = getTaskeds();




    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['action'])){

            if ($_POST['action'] == 'createTask') {
                createTasked($_POST['name'], $_POST['color'], $_POST['weekdays'], $_POST['idGroup']);
            } elseif ($_POST['action'] == 'deleteTask'){
                deleteTasked($_POST['id']);
            } elseif ($_POST['action'] == 'updateTasked'){
                updateTasked($_POST['id'], $_POST['name'], $_POST['color'], $_POST['weekdays'], $_POST['idGroup']);
            }
            
        }
        // header("Refresh:0");
        header("Location: /html/admin/tasked.php");
    }




    // create_vacation 
    
    require 'vue/tasked.php';
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