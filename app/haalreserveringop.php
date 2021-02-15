<?php
include_once("../inc/sessie.php");
include_once("../inc/dbconnection.php");
$dbconnect = new dbconnection();
$sql = "SELECT * FROM reserveringen WHERE res_id=:reservid";
$query = $dbconnect -> prepare($sql);
$query->bindParam(":reservid", $_POST['inp_reservid']);
$query ->execute();
$reserving = $query -> fetchAll(PDO::FETCH_ASSOC);
/*echo "<pre>";
print_r($reserving);
echo "</pre>";*/

$returnform = "<form id='bewerk_reservering' method='post' action='app/verwerk_bewerking.php'>
  <input type='hidden' name='resid' value='".$reserving[0]['res_id']."'>
  <input type='hidden' name='appid' value='".$reserving[0]['res_appid']."'>
  <div class='mb-3'>
    <label for='res_vanaf' class='form-label'><b>Reservering vanaf</b></label>
    <input type='text' class='form-control' name='res_vanaf' value='".$reserving[0]['res_vanaf']."'>
  </div>
  <div class='mb-3'>
    <label for='res_tot' class='form-label'><b>Reservering tot</b></label>
    <input type='text' class='form-control' name='res_tot' value='".$reserving[0]['res_tot']."'>
  </div>
</form>";
echo json_encode($returnform);