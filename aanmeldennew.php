<?php
include_once("inc/sessie.php");

$error=0;
if(isset($_GET['error']))
    $error = $_GET['error'];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>OSD's aanmeldprocedure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <div class="card" style="width: 18rem; margin-top: 20px;">
                <img src="img/Alfa_College_Logo.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <?php
                    if($error == 1) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Wachtwoorden niet gelijk!";
                        echo "</div>";
                    }
                    elseif($error == 2){
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Het e-mailadres bestaat al: gebruik een ander e-mailadres of ga naar wachtwoord vergeten!";
                        echo "</div>";
                    }
                    elseif($error == 3){
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Het wachtwoord is niet sterk genoeg; de eisen zijn: minimaal 8 tekens, 1 gewone letter, 1 hoofdletter, 1 cijfer en een vreemd teken";
                        echo "</div>";
                    }
                    ?>
                    <h5 class="card-title">Meld aan</h5>
                    <form method="POST" action="app/verwerk_aanmelding.php">
                        <div class="mb-3">
                            <label for="email">E-mailadres</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="naam@provider.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="wachtwoord1">Wachtwoord</label>
                            <input type="password" class="form-control" id="wachtwoord1" name="wachtwoord1" onkeyup="bepaalSterkte()" required>
                            <div id="wwHelp" class="form-text">8 karakters, 1 kleine letter, 1 hoofdletter, 1 cijfer, 1 vreemd teken.</div>
                        </div>
                        <div id="wachtwoordsterkte" class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mb-3">
                            <label for="wachtwoord2">Herhaal wachtwoord</label>
                            <input type="password" class="form-control" id="wachtwoord2" name="wachtwoord2" required>
                        </div>
                        <div id="submitbutton"><button type="submit" class="btn btn-primary" disabled>Aanmelden</button></div>

                    </form>

                </div>
            </div>

        </div>
        <div class="col-sm">

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/aanmelden.js"></script>
</body>
</html>


