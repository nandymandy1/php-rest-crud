
<?php
session_start();
// remove all session variables
session_unset();
$_SESSION['auth'] = false;
// destroy the session
session_destroy();

header("Location: login.php");
?>
