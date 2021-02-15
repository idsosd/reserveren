<?php
//session_start is nodig om de sessie over te nemen van de vorige pagina, daarna kan hij pas vernietigd worden......
session_start();
session_destroy();
unset($_SESSION['loggedin']);
unset($_SESSION['user_email']);
header("Location: index.php");