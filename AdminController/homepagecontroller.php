<?php

require_once '../Class/DatabaseClass.php';
require_once '../Class/UserClass.php';

class Admin extends User{
    public function getUsersCount() {
        $database = new Database();
        $db = $database->connect();
    
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['total']) ? $result['total'] : 0;
        
    }


    public function getBooksNumber(){
        $database = new Database();
        $db = $database->connect();
    
        $query = "SELECT COUNT(*) as totalBooks FROM books";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['totalBooks']) ? $result['totalBooks'] : 0;
        
    }

    public function getAvailableBooks(){
        $database = new Database();
        $db = $database->connect();
    
        $query = "SELECT COUNT(*) as availableBooks FROM books where status = 'available'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['availableBooks']) ? $result['availableBooks'] : 0;
        
    }

    public function borrowedBooks(){
        $database = new Database();
        $db = $database->connect();
    
        $query = "SELECT COUNT(*) as borrowedBooks FROM borrowings";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['borrowedBooks']) ? $result['borrowedBooks'] : 0;
        
    }

    public function displayUsers(){
        $database = new Database();
        $db = $database->connect();

        $query = "SELECT name, email, role FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return isset($results) ? $results : null;
    
    }
    
    public function displayBooks(){
        $database = new Database();
        $db = $database->connect();

        $query = "SELECT books.title, books.author, categories.name, books.cover_image, books.summary, books.status FROM books join categories on books.category_id = categories.id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return isset($results) ? $results : null;
    
    }

    public function addBook($title, $author, $cover_image, $summary, $category_id) {
        $database = new Database();
        $db = $database->connect();
    
        $query = "INSERT INTO books (title, author, cover_image, summary, category_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
    
        return $stmt->execute([$title, $author, $cover_image, $summary, $category_id]);
    }
    
    public function displayCategories(){
        $database = new Database();
        $db = $database->connect();

        $query = "SELECT * FROM categories";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return isset($results) ? $results : null;
    }

}




?>