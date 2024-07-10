<?php


// _______________________________________________
// FILE admin/vacationlist.php  
// http://localhost/html/admin/vacationlist.php 
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
    require_once '../utils/connectdb.php';
    require '../model/user.php';
    require '../model/vacation.php';
    require 'vue/partials/header.php';
    include 'vue/partials/nav.php';
    // var_dump( require '../model/user.php'); 

    // ______________________________________________________________
    // Get All Vacations or by User ID 
    // ______________________________________________________________
    if(isset($_GET['user_id'])){ 

        // GET USER VACATION 
        $user_name = $_GET['user_name'];         
        $user_id = $_GET['user_id']; 
        $user = getUserIdById($user_id); 
		$vacations = getVacationByUser($user_id);        

    } else{
        // GET ALL VACATIONS 
        $vacations = getVacations();
    }

    // ______________________________________________________________
    // IF FORM HTML (CRUD INSTRUCTIONS )
    // ______________________________________________________________
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // ______________________________________________________________
        // CREATE VACATION 
        // ______________________________________________________________
        if(isset($_POST['start']) && isset($_POST['end']) && isset($_POST['create_vacation'])){  

            $start = $_POST['start']; 
            $end = $_POST['end']; 

            // PROCESSING / HANDLING A USER'S VACATIONS
            if(isset($user_id)){ 
                // GET USER 
                $user = getUserIdById($user_id);  // var_dump($user ); die();                  
                                                        
            } else{
                // GET EMAIL FROM FORM HTML 
                $email = (string) $_POST['mail']; 

                // LOOK FOR USER 
                $user = getUserIdByEmail($email); // var_dump($user ); die(); 
            }

            // CREATE / INSERT INTO DATABASE THE NEW VACATION 
            createVacation($user['id'], $start, $end);    
        } 

        // ______________________________________________________________
        // UPDATE VACATION
        // ______________________________________________________________ 
        if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['user_id']) && isset($_POST['id_vacation']) && isset($_POST['save_changes'])) {

            $u_id = $_POST['user_id']; 

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

            //________________________________________________________________
            // PROCESSING / HANDLING A USER'S VACATIONS
            //________________________________________________________________
            if(isset($u_id)){ 
                // GET USER 
                $user = getUserIdById($u_id);  // var_dump($user ); die();                                                                      
            } else{
                // GET EMAIL FROM FORM HTML 
                $email = (string) $_POST['email']; 

                // LOOK FOR USER 
                $user = getUserIdByEmail($email); // var_dump($user ); die(); 
            }

            //________________________________________________________________
            // UPDATE TABLE VACATIONS ROW IN THE DATABASE 
            //________________________________________________________________
            updateVacation( $_POST['id_vacation'], $db_startdate, $db_enddate,  $user["id"]) ; 
        } 

        // ______________________________________________________________
        // DELETE VACATION
        // ______________________________________________________________ 
        if (isset($_POST['delete_vacation'] ) && isset($_POST['id_email'] )) {

            $email = (string) $_POST['id_email']; 
            $user = getUserIdByEmail($email); 

            deleteVacation($_POST['id_vacation']);     
        }


        // _________________________________________________________
        // PAGE REDIRECTION AFTER A CRUD ACTION
        // _________________________________________________________

        if(isset($user_id) && isset($user_name) ) {

            // GET ALL USER VACATIONS 
            $vacations = getVacationByUser($u_id);   
            header("Location: /html/admin/vacationlist.php?user_id=".$user_id."&user_name=".$user_name);
        } else{

            // GET ALL VACATIONS   
            $vacations = getVacations();   
            header("Location: /html/admin/vacationlist.php"); // header("Refresh:0");                 
        }

    }// IF FORM CALLED

    // REQUIRED/ INCLUDED FILES 
    require 'vue/vacationlist.php';
    require 'vue/partials/footer.php';
    
} else {
    // ______________________________________
    // ORIGINAL SERVEUR (LINUX) HEADER 
    // ______________________________________
    // header("Location: /admin/"); // Original KO sur XAMPP 

    // ______________________________________
    // DEV LOCAL SERVEUR (LOCAL XAMPP) HEADER 
    // ______________________________________
    header("Location: /html/admin/"); // OK sur XAMPP | Firefox : http://localhost/html/admin/ 
} 


