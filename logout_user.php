<?php
 session_status() === PHP_SESSION_ACTIVE ?: session_start();
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: login_user.php");
?>