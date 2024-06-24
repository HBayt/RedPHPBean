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


// Send mail 
function sendmail($t, $recipients) { 
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
        foreach ($recipients as $r){

            $addr = getAddresseeById((integer) $r); 
            $recipient_email =  $addr['email']; 
            $recipient_name =  $addr['name']; 

            // EMAIL FOR TASK RESPONSIBLE(S)
            $mail->addBCC($recipient_email, $name=$recipient_name);                        

        }

        // _______________________________
        // SEND ACTION 
        // _______________________________        
        $mail->send();


        if(!$mail->send()) {
            echo 'Email could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Email has been sent';
        }

    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
    }
}





// Send mail 
function sendmailToResponsibles($t, $recipient_email, $recipient_name) { 
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
        // Receivers 
        // _______________________________

        // foreach( $recipients as $recipient){echo $recipient."</br>";  } 
        // getAddresseesById( $recipients); 

        /* 
        $mail->addBCC('raphael.crivelli@battenberg.ch', $name='Raphael CRIVELLI');
        $mail->addBCC('robin.gottardo@battenberg.ch', $name='Robin GOTTARDO');
        $mail->addBCC('andy.linder@battenberg.ch', $name='Andy LINDER');
        $mail->addBCC('Richard.Grandgirard@battenberg.ch', $name='Richard Grandgirard');
        $mail->addBCC('Adriana.Aniello@battenberg.ch', $name='Adriana Aniello');
        $mail->addBCC('mohamed.ibrahim@battenberg.ch', $name='Mohamed Ibrahim');
        $mail->addBCC('Quentin.Keller@battenberg.ch', $name='Quentin Keller');
        $mail->addBCC('corinne.stotzer@battenberg.ch', $name='Corinne Stotzer');
        $mail->addBCC('stefanie.hostettler@battenberg.ch', $name='Stefanie Hostettler');
        $mail->addBCC('sylvia.baelli@battenberg.ch', $name='Sylvia Bälli');
        $mail->addBCC('monika.vonaesch@battenberg.ch', $name='Monika von Aesch');
        $mail->addBCC('elisabeth.ruckstuhl@battenberg.ch', $name='Elisabeth Ruckstuhl');
        $mail->addBCC('frank.krumm@battenberg.ch', $name='Frank Krumm');
        $mail->addBCC('dalai.wenger@battenberg.ch', $name='Dalai Wenger');
        $mail->addBCC('chloe.kessi@battenberg.ch', $name='Chloe Kessi');
        */ 

        $mail->addBCC($recipient_email, $name=$recipient_name);
        // $mail->addBCC('halide.baytar@attenberg.ch', $name='Halide BAYTAR');
        // $mail->addAddress($t->user->email, $t->user->name);
        // $mail->addAddress('halide.baytar@gmail.com', 'H. Baytar (F. addAddr.)');
       //  $mail->addBCC('halide.baytar@gmail.com', $name='H. Baytar');



        // _______________________________

        $mail->send(); 

        if(!$mail->send()) {
            echo 'Email could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Email has been sent';
        }

    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
    }
}



// Send mail 
function sendmailToExecutor($t) {
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
        /* 
            // Sender and recipient settings
            $mail->setFrom('info@mailtrap.io', 'Mailtrap'); 
            $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
            $mail->addAddress('recipient1@mailtrap.io', 'Tim'); // Primary 

            // CC (Copy Carbone) 
            $mail->addCC('cc1@example.com', 'Elena');
        */ 
        $mail->addAddress($t->user->email, $t->user->name); // Primary 





        // SEND ACTION 
        $mail->send(); 

        if(!$mail->send()) {
            echo 'Email could not be sent to task executor (SendmailToExecutor($task) ) ....';
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




?>
