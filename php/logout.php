<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['loggedin']);
session_destroy();
header("Location: ../login.php");
?>