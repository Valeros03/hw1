<?php
    require_once 'auth.php';
    if (!$username = checkAuth()) {
        header("Location: login.php");
        exit;
    }
    echo '<h1> benvenuto '.$username.' </h1>';

?>