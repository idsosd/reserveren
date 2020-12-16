<?php
include_once("inc/sessie.php");

$error=0;
if(isset($_GET['error']))
    $error = $_GET['error'];
$verified=-1;
if(isset($_GET['verified']))
    $verified = $_GET['verified'];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>OSD's aanmeldprocedure</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">

            <div class="card" style="width: 18rem; margin-top: 20px">
             <img src="img/Alfa_College_Logo.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <?php
                    if($error == 1) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "De combinatie van e-mailadres en wachtwoord is niet gevonden";
                        echo "</div>";
                    }
                    elseif ($error == 2) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Uw aanmelding is nog niet geverifieerd; klik op de link in het e-mailbericht (check ook uw spam-box)";
                        echo "</div>";
                    }
                    elseif ($error == 3) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "U moet eerst inloggen om de opgevraagde pagina te kunnen bezoeken";
                        echo "</div>";
                    }
                    if($verified == 1) {
                        echo "<div class='alert alert-success' role='alert'>";
                        echo "Uw aanmelding is geverifieerd, u kunt nu inloggen!";
                        echo "</div>";
                    }
                    elseif ($verified == 0) {
                        echo "<div class='alert alert-info' role='alert'>";
                        echo "Uw aanmelding is met succes ontvangen; check uw e-mail (ook de spambox) om uw aanmelding definitief te maken!";
                        echo "</div>";
                    }
                    ?>
                    <h5 class="card-title">Log in</h5>
                    <form method="POST" action="app/verwerk_login.php">
                        <div class="form-group">
                            <label for="email">E-mailadres</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="voorb: naam@provider.com" required>
                        </div>
                        <div class="form-group">
                            <label for="wachtwoord">Wachtwoord</label>
                            <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                    <a href="wachtwoordvergeten.php">wachtwoord vergeten?</a>
                </div>
            </div>
        </div>
        <div class="col-sm">

        </div>
    </div>
</div>
</body>
</html>