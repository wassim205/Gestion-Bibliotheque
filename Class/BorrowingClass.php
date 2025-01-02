<?php

require_once 'DatabaseClass.php';

class Borrowing {

    private $id;
    private $userId;
    private $bookId;
    private $borrowDate;
    private $dueDate;
    private  $returnDate;
    private $notificationSent;
    private $conn;


    function __construct( $db , $id = null , $userId = null , $bookId = null , $borrowDate = null , $dueDate = null , $returnDate = null , $notificationSent = null ) {
        $this->conn = $db;
        $this->id = $id;
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
        $this->notificationSent = $notificationSent;
    }

    function addBorrowingBook($book_id) {
        $book_id = intval($book_id);

        $query = "INSERT INTO borrowings (user_id, book_id, borrow_date, due_date) VALUES (:user_id, :book_id, NOW(), DATE_ADD(NOW(), INTERVAL 15 DAY))";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        try {
            $stmt->execute();
            header('Location: ../userpage.php');
            exit;
        } catch (PDOException $e) {
            error_log("Error adding borrowing record: " . $e->getMessage());
            return false;
        }
    }



}
?>
