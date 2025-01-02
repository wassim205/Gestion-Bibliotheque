<?php
require_once '../Class/BooksClass.php';
session_start();
$database = new Database();
$db = $database->connect();
$inst_book = new Book($db);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['book_id'])){
        $user_id = $_SESSION['user_id'];
        $book_id = (int)$_POST['book_id'];
        $book = $inst_book->getBook($book_id);
        if(isset($_POST['Borrow_book'])){
            $inst_book->borrowBook($book_id, $user_id);
        }
        elseif(isset($_POST['Reserve_book'])){
            $user_id = $_SESSION['user_id'];
            $inst_book->reserve_book($book_id, $user_id);
        }
    }


}

?>