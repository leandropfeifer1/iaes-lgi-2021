<?php
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['usuario']);
unset($_SESSION['id_rol']);
session_destroy();
header('location: /login-php/index.php');
?>