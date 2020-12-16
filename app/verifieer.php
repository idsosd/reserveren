<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");

$verifieercode = $_GET['id'];

//echo "verifieercode = ".$verifieercode;

$verifieercode_explode = explode("rysp",$verifieercode);
//in $verifieercode_explode[0] zit nu de userid, in $verifieercode_explode[1] zit nu een deel van het gehashte wachtwoord
$userid = $verifieercode_explode[0];
$hashdeel = $verifieercode_explode[1];

/*
echo "<pre>";
print_r($verifieercode_explode);
echo "</pre>";*/

$dbconnect = new dbconnection();
$aantalgevonden=$dbconnect->verifieerUser($userid,$hashdeel);
if($aantalgevonden == 1)
    header("Location: ../inloggen.php?verified=1");
else
    header("Location: ../aanmelden.php?error=3");
