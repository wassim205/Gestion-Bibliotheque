<?php
require_once 'Class/DatabaseClass.php';

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

    public function searchBooks($searchTerm)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE title LIKE :searchTerm";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $book = new self($this->conn);
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $books[] = $book;
        }
        return $books;
    }
}
?>
