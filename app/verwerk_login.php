<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");

$dbconnect = new dbconnection();
$wachtwoord=$dbconnect->haalWachtwoordOp($_POST['email']);

if($wachtwoord=="idsisgek"){
    //de user-status is dus nog 0, er moet nog geverifieerd worden
    $_SESSION['loggedin'] = 0;
    header("Location: ../inloggen.php?error=2");
}
else {
    if (password_verify($_POST['wachtwoord'], $wachtwoord)) {
        //de sessievariabele vullen dat je ingelogd bent
        $_SESSION['loggedin'] = 1;
        $_SESSION['user_email'] = $_POST['email'];
        //ga door naar het deel achter de login
        header("Location: ../achterdeinlog.php");
    } else {
        $_SESSION['loggedin'] = 0;
        header("Location: ../inloggen.php?error=1");
    }
}



?>
