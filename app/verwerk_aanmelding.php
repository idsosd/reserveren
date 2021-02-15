<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");

if ($_POST['wachtwoord1'] ==  $_POST['wachtwoord2']) {
    if (preg_match("#.*^(?=.{5,10})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $_POST['wachtwoord1'] )){
        //echo "Your password is strong.";
        $dbconnect = new dbconnection();
        $aantalgevonden=$dbconnect->checkEmailadres($_POST['email']);
        if($aantalgevonden == 0){
            $gehashdpassword = password_hash( $_POST['wachtwoord2'],PASSWORD_DEFAULT);
            $userid = $dbconnect->insertUser($_POST['email'],$gehashdpassword);
            //ik wil in de verifieercode graag de user_id verwerken (verstopt), zodat ik die kan gebruiken bij de identificatie: welke user is aan het verifieren
            $verifieercode = $userid."rysp".substr($gehashdpassword,4,40);
            $to = $_POST['email'].", idsosinga@idsosd.nl";
            $subject = "Aanmelding bij OSD's reserveringssyteem";
            $message = "Er is een account aangemaakt voor OSD's reserveringssysteem op dit e-mailadres:<br>".$_POST['email'];
            $message .= "<br><br>Klik op <a href='http://localhost/reserveren/app/verifieer.php?id=".$verifieercode."'>deze link</a> om het account definitief te activeren!";
            $message .= "<br><br>Als u het account NIET heeft aangemaakt, klik dan NIET op de link en neem contact op met de webmaster (idsosinga@idsosd.nl).";
            $message .= "<br><br>Met vriendelijke groet,<br>Ids Osinga<br>namens OSD's reserveringssysteemteam.";
            $headers = "From: idsosinga@idsosd.nl\r\n";
            $headers .= "Reply-To: idsosinga@idsosd.nl\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            mail($to,$subject,$message,$headers);
            header("Location: ../inloggen.php?verified=0");
        }
        else {
            header("Location: ../aanmelden.php?error=2");
        }
    } else {
        header("Location: ../aanmelden.php?error=3");
    }
}
else {
    header("Location: ../aanmelden.php?error=1");
}

