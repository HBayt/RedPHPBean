<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
function sendmail($t, $recipients) { 
    $send = "NOT_SEND"; 

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = SMTP_SECU;
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->From = SMTP_USER;
        $mail->FromName = "Task Manager";

        $mail->Subject = $t->task->name . " -> " . $t->user->name;

        // Mail Content (Body)
        $body = getMail()->text; // MySQL Request 
        $body = str_replace('/name', $t->task->name, $body);
        $body = str_replace('/date', (new DateTime($t->start))->format('d-m-y'), $body);

        $mail->CharSet = 'utf-8';
        $mail->Body = $body;
        $mail->IsHTML(true); // Set email format to HTML --> DOES NOT Set email format to plain text : $mail->IsHTML(false); 

        // _______________________________
        // Receivers / Task Executor(s)
        // _______________________________
        $mail->addAddress($t->user->email, $t->user->name); // Primary 


        // _______________________________
        // Receivers / Task Responsible(s)
        // _______________________________
        echo "recipients checked : <br> <br>"; 
        // var_dump($recipients ); 
        foreach ($recipients as $r){

            // RESPONSIBLE 
            $addr = getAddresseeById((integer) $r); 
            $recipient_email =  $addr['email']; 
            $recipient_name =  $addr['name']; 


            // echo "recipients : ".$recipient_email ." ".$recipient_name ." <br><br>"; 

            // EMAIL FOR TASK RESPONSIBLE(S)
            // $mail->addBCC($recipient_email, $name=$recipient_name);                        

        }

        // _______________________________
        // SEND ACTION 
        // _______________________________      

  
         // $mail->send();  

        
        if(! $mail->send()) {
        // if($send == "NOT_SEND") {
            echo 'Email could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Email has been sent';
        }

    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
    }
}



// Get all addressee from MySQL DB 
function getAddressee () {
    return R::findAll( 'addressee' );
}

// Get an addressee from MySQL DB 
function getAddresseeById($id) {
    return R::load( 'addressee', $id ); 
}



function getTaskedsByDate($today) {

    $timestamp = strtotime($today);
    $date_formated = date('Y-m-d H:i:s', $timestamp);
    // echo "<br> date_formated : <br> "; var_dump($date_formated);  // string(10) "2024-06-18" 
    
    $taskeds = R::find("tasked","start=?",array($date_formated));
    // echo "<br> taskeds : <br> "; var_dump($taskeds); 
    return $taskeds; 

}


?>
