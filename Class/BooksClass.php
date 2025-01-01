<?php
require_once 'DatabaseClass.php';
require_once 'BorrowingClass.php';

class Book {
    private $id;
    private $title;
    private $author;
    private $category;
    private $coverImage;
    private $summary;
    private $status ;
    private $conn;
    private $table = "books";

    function __construct($db, $id = null, $title = null, $author = null, $category = null, $coverImage = null, $summary = null , $status = null) {
        $this->conn = $db;
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->coverImage = $coverImage;
        $this->summary = $summary;
        $this->status = $status;
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }



    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }


    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }


    public function getCoverImage() {
        return $this->coverImage;
    }

    public function setCoverImage($coverImage) {
        $this->coverImage = $coverImage;
    }


    public function getSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function getBookStatus() {
        return $this->status;
    }
    public function setBookStatus($new_status) {
        $this->status = $new_status;
    }



    function getAllBooks() {
        $books = [];
        $query = "SELECT books.id, books.title, books.status, books.author, categories.name AS category, books.cover_image, books.summary
                    FROM books INNER JOIN categories ON books.category_id = categories.id ORDER BY books.status ASC";

        try {

            $stmt = $this->conn->prepare($query);
            $stmt->execute();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $book = new Book($this->conn);
                $book->id = $row['id'];
                $book->title = $row['title'];
                $book->author = $row['author'];
                $book->category = $row['category'];
                $book->coverImage = $row['cover_image'];
                $book->summary = $row['summary'];
                $book->status = $row['status'];

                $books[] = $book;
            }
        } catch (PDOException $e) {
            echo 'Error fetching books: ' . $e->getMessage();
        }

        return $books;
    }

    // public function searchBooks($searchTerm)
    // {
    //     $query = "SELECT * FROM " . $this->table . " WHERE title LIKE :searchTerm";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    //     $stmt->execute();

    //     $books = [];
    //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //         $book = new self($this->conn);
    //         $book->setId($row['id']);
    //         $book->setTitle($row['title']);
    //         $books[] = $book;
    //     }
    //     return $books;
    // }

    public function getBook($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $book = new self($this->conn);
            $book->getId($row['id']);
            $book->getTitle($row['title']);
            $book->getAuthor($row['author']);
            $book->getCategory($row['category_id']);
            $book->getCoverImage($row['cover_image']);
            $book->getSummary($row['summary']);
            $book->getBookStatus($row['status']);
            return $book;
        }
    }

    public function borrowBook($id,$userId){
        $query = "UPDATE " . $this->table . " SET status = 'borrowed' WHERE id = :id AND status = 'available'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $database = new Database();
        $db = $database->connect();
        $inst_borrowing = new Borrowing($db);
        $inst_borrowing->addBorrowingBook($id);
    }
    function reserve_book($book_id,$user_id){
        $query = "INSERT INTO reservations (user_id, book_id) VALUES (:user_id, :book_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        try {
            $stmt->execute();
            header('Location: ../userpage.php');
            exit;
        } catch (PDOException $e) {
            error_log("Error adding reservation record: " . $e->getMessage());
            return false;
        }
    }
}
?>
