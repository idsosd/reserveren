<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");

$resid = $_POST['resid'];
$appid = $_POST['appid'];

$inputdelendatumvanaf = explode(" ", $_POST['res_vanaf']);
$datumdelen = explode("-", $inputdelendatumvanaf[0]);
$deintevoerendatumentijdvanaf = $datumdelen[2]."-".$datumdelen[1]."-".$datumdelen[0]." ".$inputdelendatumvanaf[1];

$inputdelendatumtot = explode(" ", $_POST['res_tot']);
$datumdelen = explode("-", $inputdelendatumtot[0]);

$deintevoerendatumentijdtot = $datumdelen[2]."-".$datumdelen[1]."-".$datumdelen[0]." ".$inputdelendatumtot[1];

$dbconnect = new dbconnection();
$sql = "UPDATE reserveringen SET res_vanaf=:vdatum, res_tot=:tdatum WHERE res_id=:resid";
$query = $dbconnect -> prepare($sql);
$query->bindParam(":vdatum", $_POST['res_vanaf']);
$query->bindParam(":tdatum", $_POST['res_tot']);
$query->bindParam(":resid", $resid);
$query ->execute();


header("Location: ../achterdeinlog.php?appid=".$appid);

