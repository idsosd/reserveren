<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");

$appid = $_GET['appid'];
//eigenlijk nog ff checken of de datums ingevuld zijn en ook kloppen

$inputdelendatumvanaf = explode(" ", $_POST['datumvanaf_'.$appid]);
/*
echo "<pre>";
print_r($inputdelendatumvanaf);
echo "</pre>";

echo "de datum zit in het 0de element: ".$inputdelendatumvanaf[0];
*/
$datumdelen = explode("-", $inputdelendatumvanaf[0]);
/*
echo "<pre>";
print_r($datumdelen);
echo "</pre>";
*/
$deintevoerendatumentijdvanaf = $datumdelen[2]."-".$datumdelen[1]."-".$datumdelen[0]." ".$inputdelendatumvanaf[1];
//echo $deintevoerendatumentijdvanaf;

$inputdelendatumtot = explode(" ", $_POST['datumtot_'.$appid]);
/*
echo "<pre>";
print_r($inputdelendatumtot);
echo "</pre>";

echo "de datum zit in het 0de element: ".$inputdelendatumtot[0];
*/
$datumdelen = explode("-", $inputdelendatumtot[0]);
/*
echo "<pre>";
print_r($datumdelen);
echo "</pre>";
*/
$deintevoerendatumentijdtot = $datumdelen[2]."-".$datumdelen[1]."-".$datumdelen[0]." ".$inputdelendatumtot[1];
//echo $deintevoerendatumentijdtot;


$dbconnect = new dbconnection();
$sql = "INSERT INTO reserveringen (res_userid, res_appid, res_vanaf, res_tot) VALUES(:uid,:aid,:vdatum,:tdatum)";
$query = $dbconnect -> prepare($sql);
$query->bindParam(":uid",  $_SESSION['user_id']);
$query->bindParam(":aid", $appid);
$query->bindParam(":vdatum", $deintevoerendatumentijdvanaf);
$query->bindParam(":tdatum", $deintevoerendatumentijdtot);
$query ->execute();


header("Location: ../achterdeinlog.php?appid=".$appid);

