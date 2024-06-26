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
    require '../model/mail.php';
    include 'vue/partials/nav.php'; 
    

    // To send mail 
    // require __DIR__ . '/../config.php';
    // require_once __DIR__ . '/../utils/connectdb.php';
    require __DIR__ . '/../model/task.php';





    // ____________________________________________
    // Manage Mail 
     // ____________________________________________
    createDefaultMail(DEFAULT_MAIL); // DEFAULT_MAIL (//Default mail message) -> Variable from /html/config.php 
    $mail = getMail();
    
    if(isset($_POST) && isset($_POST['mail'])) {
        updateMail($_POST['mail']);
        header("Refresh:0");
    }


    // ____________________________________________
    // Manage Addressees (Mail Receivers)
    // ____________________________________________

   
    // ____________________________________________ 
    // Manage Addressees (Mail Receivers) for View /vue/addressee.php 
    // ____________________________________________
    $addressees = getAddressee (); 
    // var_dump($addressees ); 



    // ____________________________________________
    // TEST CHECK LIST OF RECIPIENTS / ADDRESSEES 
    // ____________________________________________

    if(isset($_POST['send_mail']) && isset($_POST['check_list'])){//to run PHP script on submit
        
        if(!empty($_POST['check_list'])){
            
            $recipients = $_POST['check_list']; 
            // var_dump($recipients); // RESULT : array(3){[0]=>string(1) "2" [1]=> string(2) "14" [2] => string(2) "22"}
            // echo "</br></br>";

            foreach($_POST['check_list'] as $selected){  // Loop to store and display values of individual checked checkbox.
                // echo $selected."</br>";
                /* RESULT : 
                2
                14
                22
                */ 
            }
        }
    } // OK 




// _____________________________________________________________________________________________________________________
// _____________________________________________________________________________________________________________________


    // ____________________________________________
    // SI Bouton SEND cliqué
    // ____________________________________________



    // CREATE UNE LISTE D'EXPEDITEURS (ADDRESSEES) A PARTIR DES ID SELECTIONNES 

    if(isset($_POST['send_mail']) && isset($_POST['check_list'])){//to run PHP script on submit

        if(!empty($_POST['check_list'])){
            
            $bcc_recipients = $_POST['check_list']; 
            // var_dump($bcc_recipients); // array(3){[0]=>string(1) "2" [1]=> string(2) "14" [2] => string(2) "22"}
            // echo sizeof("Number of Addressees : ".$bcc_recipients);
            
            sendmail($bcc_recipients); 
          
            // alert("YourMessage : ".$msg);
            //  echo "</br></br>";
        }

	
		// header("Refresh:0");
        header("Location: /html/admin/addressee.php");
		
    } // OK 





// _____________________________________________________________________________________________________________________
// _____________________________________________________________________________________________________________________


    // _________________________________________________
    // CREATE ADDRESSEE 
    // _________________________________________________
    if(isset($_POST['create_addressee']) && isset($_POST['addr_name']) && isset($_POST['addr_email'])){    
        $name = $_POST['addr_name']; 
        $email = $_POST['addr_email']; 
        // var_dump( $email); 
        createAddressee ($name, $email); 
		
		// header("Refresh:0");
        // header("Location: /html/admin/addressee.php");

    }


    // _________________________________________________
    // DELETE ADDRESSEE 
    // _________________________________________________
    if(isset($_POST['delete_addressee']) && isset($_POST['id_addressee'])){    
        $id = $_POST['id_addressee']; 
        // var_dump( $id); 
        deleteAddressee($id); 
		
		// header("Refresh:0");
        // header("Location: /html/admin/addressee.php");

    }


    // _________________________________________________
    // UPDATE ADDRESSEE 
    // _________________________________________________
    if(isset($_POST['update_addressee']) && isset($_POST['id_addressee'])){    
       // echo "hell0"; // check if PHP interpreter enters in the function 
        $id = $_POST['id_addressee']; 
        $name = $_POST['addr_name']; 
        $email = $_POST['addr_email']; 

        /* 
        var_dump( $id); 
        var_dump( $name); 
        var_dump( $email); 
        */ 

        updateAddressee($id, $name, $email); 
		
		// header("Refresh:0");
        // header("Location: /html/admin/addressee.php");

    }



    // _____________________________________________________________________________________________________________________
    // _____________________________________________________________________________________________________________________



    // Vues
    include 'vue/addressee.php';    
    require 'vue/partials/footer.php';

} else {
   header("Location: /html/admin/");
} 



