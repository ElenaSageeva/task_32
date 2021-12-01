<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

session_start();
include 'connect.php';

$log = new Logger('register');
    $log->pushHandler(new StreamHandler('../log.txt', Logger::ERROR));

    if (isset($_POST['submit'])) {
        $errors = null;

        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

        if (empty($login) || empty($password) || empty($confirmPassword)) {
            $errors = 'login or password cannot be empty';
        } elseif (strlen($login) < 3) {
            $errors = 'login must be at least 3 characters';
        } elseif ($password !== $confirmPassword) {
            $errors = 'login and password do not match';
        } else {
            $query = "SELECT login FROM users WHERE login='" . $login . "'";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) $errors = 'such user is already registered';
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $log->error($errors);
            header('Location:/register.php');
            return;
        }

        $query = "INSERT INTO users VALUES (null, '" . $login . "', '" . $password . "', '')";
        mysqli_query($link, $query);

        unset($_SESSION['errors']);

        header('Location:/');
    }
