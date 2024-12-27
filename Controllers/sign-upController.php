<?php
require_once '../Class/DatabaseClass.php';
require_once '../Class/UserClass.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    $user->setEmail($_POST['email']);
    $user->setName($_POST['user_name']);
    $user->setPassword($_POST['password']);

    $user->registerUser();

    header("location :../login.php");

}
?>
