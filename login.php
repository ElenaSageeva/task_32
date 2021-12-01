<?php

use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    session_start();

    include 'connect.php';

    $log = new Logger('auth');
    $log->pushHandler(new StreamHandler('../log.txt', Logger::ERROR));

    if (isset($_POST['submit'])) {
        if ($_POST['CSRF_token'] !== $_SESSION['CSRF_token']) {
            header('Location:/');
            return;
        }

        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));

        if (empty($login) || empty($password)) {
            $errors = 'login or password cannot be empty';
        } else {
            $query = "SELECT * FROM users WHERE login='" . $login . "'";
            $result = mysqli_query($link, $query);

            if (!mysqli_num_rows($result)) $errors = 'no such user found';
            else {
                $row = mysqli_fetch_assoc($result);

                if (!password_verify($password, $row['password'])) $errors = 'username or password entered incorrectly';
            }
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $log->error($errors);
            header('Location:/');
            return;
        }
        
        unset($_SESSION['errors']);
        $_SESSION['login'] = $row['login'];

        header('Location:/welcome.php');
    }

        