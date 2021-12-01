<?php

    session_start();
    include 'connect.php';

    $query = "UPDATE users SET cookie='' WHERE login='" . $_SESSION['login'] . "'";
    mysqli_query($link, $query);
    setcookie('remember', '', time() - 3000, '/');

    session_destroy();
    header('Location:/');