<?php
require '../Class/DatabaseClass.php';
require '../AdminController/homepagecontroller.php';

if (isset($_POST['insertBook'])) {
    // Get the input values from the form
    $title = $_POST['title'];
    $cover_image = $_POST['cover_image'];
    $author = $_POST['author'];
    $summary = $_POST['summary'];
    $category_id = $_POST['category'];

    
$database = new Database();
$db = $database->connect();

    $admin = new Admin($db);

    $admin->addBook($title, $author, $cover_image, $summary, $category_id);
        header('Location: ../AdminPages/Books.php?message=Book added successfully');
   }

?>