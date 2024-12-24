<?php
require_once '../Class/DatabaseClass.php';
require_once '../Class/UserClass.php';


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);


    $loggedInUser = $user->login();


    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['email'] = $loggedInUser['email'];
        $_SESSION['role'] = $loggedInUser['role'];
        if($_SESSION['role'] == 'admin'){
            header('Location: dashboard.php');
        }
        else{
            header('Location: userpage.php');
        }

    } else {
        echo "Identifiants incorrects.";
    }
}
?>