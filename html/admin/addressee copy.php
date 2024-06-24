<?php
// admin/mail.php 

session_start(); 

/*
if (!empty($_SERVER['REMOTE_ADDR'])) {

    // If a "remote" address is set, we know that this is not a CLI call
    header('HTTP/1.1 403 Forbidden');
    die('Access denied. Go away, shoo!');
    
  }

*/ 
if($_SESSION["login"]) {
    
    require '../config.php';
    require 'vue/partials/header.php';
    include '../utils/connectdb.php';
    require '../model/mail_4u.php';
    include 'vue/partials/nav.php'; 
    

    // To send mail 
    // require __DIR__ . '/../config.php';
    // require_once __DIR__ . '/../utils/connectdb.php';
    require __DIR__ . '/../model/task.php';





    // ______________________________________________________________
    // Manage Mail 
    // ______________________________________________________________
    createDefaultMail(DEFAULT_MAIL); // DEFAULT_MAIL (//Default mail message) -> Variable from /html/config.php 
    $mail = getMail();
    
    if(isset($_POST) && isset($_POST['mail'])) {
        updateMail($_POST['mail']);
        // header("Refresh:0");
        header("Location: /html/admin/addressee.php"); 
    }


    // Manage Addressees (Mail Receivers) for View /vue/addressee.php 
    $addressees = getAddressee (); 
/*
    if(isset($_POST['submit']) && isset($_POST['check_list'])){//to run PHP script on submit
        if(!empty($_POST['check_list'])){
            
            $recipients = $_POST['check_list']; 
            var_dump($recipients); 
            echo $selected."</br></br>";

            // Loop to store and display values of individual checked checkbox.
            foreach($_POST['check_list'] as $selected){
                echo $selected."</br>";
            }
        }
    }
*/ 





    // ______________________________________________________________
    // IF Button SEND clicked
    // ______________________________________________________________


    $date   = new DateTime(); //this returns the current date time
    $today = date("Y-m-d");    
    // $result = $date->format('Y-m-d');

    // var_dump($taskeds); 


    // $tasked = R::findall('tasked');
    $now = new DateTime('Today');
    $now->setTime(0, 0, 0, 0); 

    $taskeds = getTaskedsByDate($today);   


    if(isset($_POST['submit']) && isset($_POST['check_list'])){//to run PHP script on submit

        if(!empty($_POST['check_list'])){
            
            // Checked Responsibles 
            $recipients = $_POST['check_list'];  
            var_dump($recipients ); 

            // Get current Task (for today)
            foreach ($taskeds as $t){
                
                $start_date = new DateTime($t->start);
                // if($start_date == $now){ sendmail($t, $recipients); } // OK 

                // Send email to Responsible(s)
                // EMAIL FOR TASK RESPONSIBLE(S)
            } 
            
        }


        header("Location: /html/admin/addressee.php");
                       
    }

    // Vues
    include 'vue/addressee.php';    
    require 'vue/partials/footer.php';

} else {
   header("Location: /html/admin/");
} 



