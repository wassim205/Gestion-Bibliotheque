<?php
ob_start();
session_start();

require_once '../Class/DatabaseClass.php';
require_once '../AdminController/homepagecontroller.php';
require_once '../AdminPages/UsersManaging.php';

if (isset($_POST['changeRole'])) {
    $userId = $_POST['user_id'];
    $newRole = $_POST['role'];
    $admin->ChangeRole($userId, $newRole);
    header('Location: ../AdminPages/UsersManaging.php');
    ob_end_flush();
    exit;
}