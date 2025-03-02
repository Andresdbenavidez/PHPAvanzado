<?php
    require_once './controllers/Connection.php';
    require_once './models/user.php';
    require_once './models/model.php';
    use Controller\Connection;
    use Models\User;

    $connection = new Connection();

    $user = new User("Santiago", "santi@gmail.com", "IT Department", "password");
    $user->save($connection);

    echo User::login($connection, "santi@gmail.com", "password");
?>