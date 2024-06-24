<?php
// admin/mail.php 

session_start(); 

if($_SESSION["login"]) {
    
    require '../config.php';
    require 'vue/partials/header.php';
    include '../utils/connectdb.php';
    require '../model/mail_4u.php';
    include 'vue/partials/nav.php'; 
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



    // ______________________________________________________________
    // IF Button SEND clicked
    // ______________________________________________________________


    $date   = new DateTime(); //this returns the current date time
    $today = date("Y-m-d");    

    $taskeds = getTaskedsByDate($today);   
    // var_dump($taskeds);
    // var_dump( $_POST['send']); 

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // TODO TODO 

    if(isset($_POST['send']) && isset($_POST['check_list'])){//to run PHP script on submit
    // if(isset($_POST['send'])){//to run PHP script on submit

        // var_dump( $_POST['check_list']); 

        if(!empty($_POST['check_list'])){
            
            // Checked Responsibles 
            $recipients = $_POST['check_list'];  
            var_dump($recipients ); 

            // Get current Task (for today)
            foreach ($taskeds as $t){
                
                $start_date = new DateTime($t->start); 


                // Send email to Responsible(s)
                // EMAIL FOR TASK RESPONSIBLE(S)
                // if($start_date == $now){ sendmail($t, $recipients); } // OK                 
            } 
            
        }

        // header("Refresh:0");
        // header("Location: /html/admin/addressee.php");
                       
    }


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



