<?php
require_once '../Class/DatabaseClass.php';
require_once '../AdminController/homepagecontroller.php';

$database = new Database();
$db = $database->connect();
$admin = new Admin($db);

// Insert Book
if (isset($_POST['insertBook'])) {
    try {
        $title = trim($_POST['title']);
        $cover_image = trim($_POST['cover_image']);
        $author = trim($_POST['author']);
        $summary = trim($_POST['summary']);
        $category_id = $_POST['category'];

        if ($admin->addBook($title, $author, $cover_image, $summary, $category_id)) {
            header('Location: ../AdminPages/Books.php?success=Book added successfully');
        } else {
            header('Location: ../AdminPages/Books.php?error=Failed to add book');
        }
        exit();
    } catch (Exception $e) {
        header('Location: ../AdminPages/Books.php?error=An error occurred');
        exit();
    }
}

// Update Book
if (isset($_POST['updateBook'])) {
    try {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $cover_image = trim($_POST['cover_image']);
        $author = trim($_POST['author']);
        $summary = trim($_POST['summary']);
        $category_id = $_POST['category'];

        if ($admin->updateBook($id, $title, $author, $cover_image, $summary, $category_id)) {
            header('Location: ../AdminPages/Books.php?success=Book updated successfully');
        } else {
            header('Location: ../AdminPages/Books.php?error=Failed to update book');
        }
        exit();
    } catch (Exception $e) {
        header('Location: ../AdminPages/Books.php?error=An error occurred');
        exit();
    }
}

// Delete Book
if (isset($_POST['deleteBook'])) {
    try {
        $id = $_POST['id'];

        if ($admin->deleteBook($id)) {
            header('Location: ../AdminPages/Books.php?success=Book deleted successfully');
        } else {
            header('Location: ../AdminPages/Books.php?error=Failed to delete book');
        }
        exit();
    } catch (Exception $e) {
        header('Location: ../AdminPages/Books.php?error=An error occurred');
        exit();
    }
}
