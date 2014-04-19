<?php
// Mail functie

function mailNow($naar, $onderwerp, $message, $knaam) {

        // Uitvoeren
        $mail_headers  = 'MIME-Version: 1.0' . "\r\n";
        $mail_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $mail_headers .= 'To: '.$knaam.' <'.$naar.'>' . "\r\n";
        $mail_headers .= 'From: Developers4you <no-reply@developers4you.nl>' . "\r\n";
        mail($naar, $onderwerp, $message, $mail_headers);

}

?>