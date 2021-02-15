<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");

$dbconnect = new dbconnection();
$sql = "DELETE FROM reserveringen WHERE res_id=:reservid";
$query = $dbconnect -> prepare($sql);
$query->bindParam(":reservid",  $_GET['resid']);
$query ->execute();

header("Location: ../achterdeinlog.php?appid=".$_GET['appid']);

