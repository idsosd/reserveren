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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
                    ?>
                    <h5 class="card-title">Meld aan</h5>
                    <form method="POST" action="app/verwerk_aanmelding.php">
                        <div class="form-group">
                            <label for="email">E-mailadres</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="voorb: naam@provider.com" required>
                        </div>
                        <div class="form-group">
                            <label for="wachtwoord1">Wachtwoord</label>
                            <input type="password" class="form-control" id="wachtwoord1" name="wachtwoord1" required>
                        </div>
                        <div class="form-group">
                            <label for="wachtwoord2">Herhaal wachtwoord</label>
                            <input type="password" class="form-control" id="wachtwoord2" name="wachtwoord2" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Aanmelden</button>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-sm">

        </div>
    </div>
</div>
</body>
</html>


