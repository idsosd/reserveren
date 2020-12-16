<?php
session_destroy();
unset($_SESSION['loggedin']);
unset($_SESSION['user_email']);
header("Location: index.php");