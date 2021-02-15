<?php
$percentage = 0;
if (preg_match("#.*^(?=.{8,10}).*$#", $_POST['inp_wachtwoord'] )){
    $percentage+=20;
}
if (preg_match("#.*^(?=.*[a-z]).*$#", $_POST['inp_wachtwoord'] )){
    $percentage+=20;
}
if (preg_match("#.*^(?=.*[A-Z]).*$#", $_POST['inp_wachtwoord'] )){
    $percentage+=20;
}
if (preg_match("#.*^(?=.*[0-9]).*$#", $_POST['inp_wachtwoord'] )){
    $percentage+=20;
}
if (preg_match("#.*^(?=.*\W).*$#", $_POST['inp_wachtwoord'] )){
    $percentage+=20;
}

if($percentage==20){
    $kwaliteit = "zeer zwak";
    $background = "bg-danger";
}
elseif($percentage==40) {
    $kwaliteit = "zwak";
    $background = "bg-danger";
}
elseif($percentage==60) {
    $kwaliteit = "wel aardig";
    $background = "bg-warning";
}
elseif($percentage==80) {
    $kwaliteit = "sterk";
    $background = "bg-warning";
}
elseif($percentage==100) {
    $kwaliteit = "zeer sterk";
    $background = "bg-success";
}
echo "<div class='progress-bar {$background}' role='progressbar' style='width: {$percentage}%;' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100'>{$kwaliteit}</div>";