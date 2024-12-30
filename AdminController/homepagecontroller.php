<?php

require_once '../Class/DatabaseClass.php';
require_once '../Class/UserClass.php';

class Admin extends User
{

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUsersCount()
    {

        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return isset($result['total']) ? $result['total'] : 0;
    }


    public function getBooksNumber()
    {

        $query = "SELECT COUNT(*) as totalBooks FROM books";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return isset($result['totalBooks']) ? $result['totalBooks'] : 0;
    }

    public function getAvailableBooks()
    {
        $query = "SELECT COUNT(*) as availableBooks FROM books where status = 'available'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return isset($result['availableBooks']) ? $result['availableBooks'] : 0;
    }

    public function borrowedBooks()
    {

        $query = "SELECT COUNT(DISTINCT borrowings.book_id) as borrowedBooks FROM borrowings";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return isset($result['borrowedBooks']) ? $result['borrowedBooks'] : 0;
    }

    public function totalBorrowedBooks()
    {

        $query = "SELECT COUNT(borrowings.book_id) as totalTimeBorrowedBooks FROM borrowings";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return isset($result['totalTimeBorrowedBooks']) ? $result['totalTimeBorrowedBooks'] : 0;
    }

    public function displayUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return isset($results) ? $results : null;
    }

    public function displayBooks()
    {
        $query = "SELECT books.id, books.title, books.author, categories.name, books.cover_image, books.summary, books.status 
              FROM books 
              JOIN categories ON books.category_id = categories.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return isset($results) ? $results : null;
    }

    public function addBook($title, $author, $cover_image, $summary, $category_id)
    {

        $query = "INSERT INTO books (title, author, cover_image, summary, category_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$title, $author, $cover_image, $summary, $category_id]);
    }

    public function displayCategories()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return isset($results) ? $results : null;
    }

    public function topBorrowedBooks()
    {
        $query = "SELECT books.title, books.author, COUNT(borrowings.book_id) as borrow_count 
        FROM borrowings 
        JOIN books ON borrowings.book_id = books.id 
        GROUP BY borrowings.book_id 
        ORDER BY borrow_count DESC 
        LIMIT 3";

        $stmt = $this->db->prepare($query);

        if ($stmt->execute()) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return isset($results) ? $results : null;
        } else {
            return null;
        }
    }
    public function ActiveUsers()
    {
        $query = "SELECT users.name, users.email, COUNT(borrowings.user_id) as borrowTimes
        FROM borrowings JOIN users ON borrowings.user_id = users.id 
        GROUP BY borrowings.user_id LIMIT 3";

        $stmt = $this->db->prepare($query);

        if ($stmt->execute()) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return isset($results) ? $results : null;
        } else {
            return null;
        }
    }

    public function ChangeRole($id, $role)
    {
        $query = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$role, $id]);
    }

    public function updateBook($id, $title, $author, $cover_image, $summary, $category_id)
    {
        $query = "UPDATE books SET title = ?, author = ?, cover_image = ?, summary = ?, category_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$title, $author, $cover_image, $summary, $category_id, $id]);
    }

    public function deleteBook($id)
    {
        $query = "DELETE FROM books WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}
