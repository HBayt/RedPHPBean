<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . "/../vendor/autoload.php";


// UPDATE `tasked` SET `title`='Halide BAYTAR',`user_id`=128 WHERE `start`=curdate(); 


// Create mail into MySQL DB if not mail found 
function createDefaultMail ($text) {

    $mails = R::findAll( 'mail' );

    if($mails == []) {
        $mail = R::dispense( 'mail' );
        $mail->text = $text;
        $id = R::store( $mail );
    }

}

// Get mail from MySQL DB 
function getMail () {
    $mails = R::findAll( 'mail' );
    return $mails[1];
}

// Update mail from MySQL DB 
function updateMail ($text) {
    $mail = getMail();
    $mail->text = $text;
    R::store($mail);
}



// ___________________________________________________________________________________________________________________________
// ___________________________________________________________________________________________________________________________

//________________________________________________________
// Send mail 
//________________________________________________________

function sendmail($bcc_resipients) {

    $taskeds = R::findall('tasked');
    $now = new DateTime('Today');
    $now->setTime(0, 0, 0, 0);
    $now = $now->format('Y-m-d'); // $now = $now->format('Y-m-d H:i:s'); 

    /*
    echo "<h1> Hello World! </h1><br>"; 
    var_dump($taskeds); // OK 
    echo "<br> <br>"; 
    */ 

    try {

                $mail = new PHPMailer(true); // Tentative de création d’une nouvelle instance de la classe PHPMailer, avec les exceptions activées

                // SMTP Configuration
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = SMTP_SECU;
                $mail->Host = SMTP_HOST; // Your SMTP server
                $mail->Port = SMTP_PORT;
                $mail->Username = SMTP_USER; // Your Mailtrap username
                $mail->Password = SMTP_PASS; // Your Mailtrap password


        foreach ($taskeds as $t){ 

            /* 
                // echo "<h1> Task date : ". $result."/ now date : ".$now ."</h1><br>"; // OK 
                // echo "<h3> Task to do : ". $t->task->name . " -> User task email : ". $t->user->email."/  name : ".$t->user->name ."</h3><br>"; // OK 
                // var_dump($date); // OK -> $date NOT EQUALS CURRENTDATE() 
            */   
                
            // Task start date
            $date = new DateTime($t->start);
            $result = $date->format('Y-m-d');    

            if($result == $now){ 

                // echo "<h1> Task date : ". $result."/ now date : ".$now ."</h1><br>"; // OK 
                // echo "<h3> Task to do : ". $t->task->name . " -> User task email : ". $t->user->email."/  name : ".$t->user->name ."</h3><br>"; // OK 
                // var_dump($date); // OK -> $date NOT EQUALS CURRENTDATE()
     
                         
                // _______________________________
                // Sender and recipient settings                
                // _______________________________


                // Sender (Expéditeur) 
                // $mail->From = SMTP_USER;  $mail->FromName = "Task Manager";
                $mail->setFrom(SMTP_USER, "Task Manager");


                // Destinataire dont le nom peut également être indiqué en option --> $mail->addAddress($t->user->email); // Primary (To)
                $mail->addAddress($t->user->email, $t->user->name); // Primary (To) 
 

                // Send Copies function
                // $mail->addCC('info@exemple.fr');


                // // Copies cachées
                // var_dump($bcc_resipients); echo "<br> <br>"; // $bcc_resipients for each Task 
                foreach($bcc_resipients as $bcc){        

                    // var_dump($bcc ); 

                    // FIND ADDRESSEE 
                    $addressee = getAddresseeById($bcc); 
                    // var_dump(getAddresseeById($bcc)); 
                    // var_dump($addressee ); 

                    $bcc_name = $addressee['name']; // var_dump($name ); 
                    $bcc_email = $addressee['email']; //  var_dump($email )

                    
                    // echo "<h1> Recipient email : ". $bcc_email."/ recipient name : ".$bcc_name ."</h1><br>"; // OK 
                    // echo "<h3> Task to do : ". $t->task->name . " -> User task email : ". $t->user->email."/  name : ".$t->user->name ."</h3><br><br>"; // OK 

                    // $mail->addBCC($bcc_email, $name=$bcc_name); 
                    $mail->addBCC($bcc_email,$bcc_name); 

                }// addBCC() 

                // Email Content (Body)
                $mail->IsHTML(true); // Set email format to HTML --> DOES NOT Set email format to plain text : $mail->IsHTML(false); 
                $mail->Subject = $t->task->name . " -> " . $t->user->name; // Objet 

                // CREATE HTML-Content 
                $body = getMail()->text; // MySQL Request 
                $body = str_replace('/name', $t->task->name, $body);
                $body = str_replace('/date', (new DateTime($t->start))->format('d-m-y'), $body);

                // $mail->Body = 'Le texte de votre email en HTML. Il est également possible des mettre des éléments en <b>gras</b>, par exemple.';
                $mail->Body = $body;
                // $mail->AltBody = 'Le texte comme simple élément textuel';


                // Ajouter une pièce jointe
                // $mail->addAttachment("/home/user/Desktop/image.png", "image.png");
                
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

                // _______________________________
                // SEND
                // _______________________________
                // Method One 
                // $mail->send();  

                // Method Two 
                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;

                } else {
                    echo 'Message has been sent';
                }


                // clear addresses of all types             
                $mail->ClearAddresses();  // each AddAddress add to list
                /* 
                $mail->ClearCCs();
                $mail->ClearBCCs();
                $mail->ClearAllRecipients(); 

                */   
            } 
        }
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: <br>'. $mail->ErrorInfo; 
        echo $e->getMessage();
    }
}// Send mail 


// _____________________________________________________________________________________________________________________
// _____________________________________________________________________________________________________________________

// Get all addressee from MySQL DB 
function getAddressee () {
    return R::findAll('addressee');
}

// Get an addressee from MySQL DB 
function getAddresseeById($id) {
    return R::load('addressee', $id ); 
}


// Insert Into 'Addressee'
function createAddressee ($name, $email) {
    $addressee = R::dispense('addressee');
    $addressee->name = $name;
    $addressee->email = $email;
    return R::store( $addressee );
}

// Delete 'Addressee' Row
function deleteAddressee($id) {
    $addressee = R::load('addressee', $id ); 
    R::trash( $addressee );
}


// Update 'Addressee' Row
function updateAddressee($id, $name, $email) {
    $addressee = R::load( 'addressee', $id );
    $addressee->name = $name;
    $addressee->email = $email;
    R::store( $addressee );
}



// _____________________________________________________________________________________________________________________
// _____________________________________________________________________________________________________________________



function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


?>