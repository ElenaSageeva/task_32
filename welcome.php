<?php
    session_start();
    include 'auth/role.php';

    if (!$auth) header('Location:/');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" />
    <title>welcome</title>
</head>
<body>

    <div class="welcome">

        <div><p>welcome, <?=$login;?> |</p> <a href="auth/logout.php">logout</a></div>

    </div>

</body>
</html>