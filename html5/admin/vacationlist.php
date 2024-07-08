<?php

session_start();

if($_SESSION["login"]) {
    require '../config.php';
    require_once '../utils/connectdb.php';
    require '../model/user.php';
    // var_dump( require '../model/user.php'); 
    require '../model/vacation.php';
   
    require 'vue/partials/header.php';
    include 'vue/partials/nav.php';


    // ______________________________________________________________
    // Get All Vacations or by User ID 
    // ______________________________________________________________
    // 

   
    if(isset($_POST) &&  isset($_GET['user_id'])){ // ERROR 

        // $vacation_name = $_GET['user_name'];
        $vacation_id = $_GET['user_id']; 
        
        $vacations = getVacationByUser($_GET['user_id']);     
        
    }
    else{$vacations = getVacations();}

    

    // ______________________________________________________________
    // CREATE VACATION 
    // ______________________________________________________________
    if(isset($_POST) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['mail']) && isset($_POST['create_vacation'])){ // ERROR 
    
        $email = (string) $_POST['mail']; 
        $user = getUserIdByEmail($email); 
        $vacations = getVacationByUser($user['id']);  
        createVacation($user['id'], $_POST['start'], $_POST['end']);    

       // header("Refresh:0"); 
       header("Location: /html/admin/vacationlist.php?user_id=".$user['id']."&user_name=".$user["name"]);

    } 

    // ______________________________________________________________
    // UPDATE VACATION
    // ______________________________________________________________ 



        if (isset($_POST) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['user_id']) && isset($_POST['id_vacation']) && isset($_POST['save_changes'])) {
            /* 
                echo $_POST['user_id'] ; 
                var_dump($_POST['id_vacation']); 
                var_dump($_POST['start']); 
                var_dump($_POST['end']); 
                var_dump($_POST['user_id']); 
                var_dump($_POST['update_vacation']); 
            */ 


            //________________________________________________________________
            // Form - date format 30.11.2000 | DB - date format 2002-10-23            
            //________________________________________________________________
            $formatInput = 'd.m.Y'; // HTML FORM format 
            $formatDb = 'Y-m-d'; // MySQL DB format


            // Dates from HTML FORM for 'Vacation Update'
            $startdate = DateTime::createFromFormat($formatInput, $_POST['start']); 
            $enddate = DateTime::createFromFormat($formatInput, $_POST['end']);

            // Dates converted for DB MySQL 
            $db_startdate = $startdate->format( $formatDb); 
            $db_enddate = $enddate->format($formatDb); 

            // RESULTS TESTS 
            /*
                echo "Bevor <br>"; // 30.11.2000
                echo $startdate."<br>"; 
                echo $enddate."<br><br>";             
                
                echo "After <br>";  
                echo $db_startdate."</br>";
                echo $db_enddate."</br>"; // 2029-12-23
            */ 


            // var_dump($vacation['start'] ) ; 
            // var_dump($vacation['end'] ); 
            // var_dump($vacation['name'] ) ; 
            // var_dump($_POST['email'] ) ;   
            // var_dump(getUserIdByEmail($email));   
            // var_dump($_POST['user_id']);         //  timo.blum@battenberg.ch // strval()

            $email = (string) $_POST['email'] ;    
            $user = getUserIdByEmail($email); 
            $vacations = getVacationByUser($user['id']);   


            // updateVacation( $_POST['update_vacation'], $_POST['start'],  $_POST['end'], $_GET['user_id']) ; 
            updateVacation( $_POST['id_vacation'], $db_startdate, $db_enddate,  $user["id"]) ; 
 
    
            // header("Refresh:0"); 
            // header("Location: /html/admin/vacationlist.php");           
            header("Location: /html/admin/vacationlist.php?user_id=".$user['id']."&user_name=".$user["name"]);

        } 

    // ______________________________________________________________
    // DELETE VACATION
    // ______________________________________________________________ 
    // if (isset($_POST) && isset($_POST['delete_vacation'] )) {
        if (isset($_POST['delete_vacation'] ) && isset($_POST['id_email'] )) {

            $email = (string) $_POST['id_email']; 
            $user = getUserIdByEmail($email); 
            $vacations = getVacationByUser($user['id']);    
            // var_dump($user['id']);   

            deleteVacation($_POST['id_vacation']);

            // header("Refresh:0"); 
            //  header("Location: /html/admin/vacationlist.php");               
            // header("Location: /html/admin/vacationlist.php?user_id=".$user['id']);
            header("Location: /html/admin/vacationlist.php?user_id=".$user['id']."&user_name=".$user["name"]);
    
    
        }

    
    require 'vue/vacationlist.php';
    require 'vue/partials/footer.php';
        
    } else {
        header("Location: /html/admin/");
    } 


