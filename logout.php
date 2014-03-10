<?php
session_start();

session_destroy();

echo '<script type="text/javascript"> window.open("login.php","_self");</script>';
?>