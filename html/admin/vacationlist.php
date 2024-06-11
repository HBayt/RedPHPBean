<?php

session_start();

if($_SESSION["login"]) {
    require '../config.php';
    require_once '../utils/connectdb.php';
    require '../model/user.php';
    require '../model/vacation.php';

    
    require 'vue/partials/header.php';
    include 'vue/partials/nav.php';

    $vacations = getVacations(); 

    if (isset($_POST) && isset($_POST['id'])) {


        deleteVacation($_POST['id']);

        // $_GET['user_id'] 

        // var_dump(isset($_POST)); // TRUE
        var_dump($_POST['id']); // 3, 128 
        // var_dump($_POST['user_id']); 
      


        header("Refresh:0");
    }



    require 'vue/vacationlist.php';
    require 'vue/partials/footer.php';



    
} else {
    header("Location: /html/admin/");
} 