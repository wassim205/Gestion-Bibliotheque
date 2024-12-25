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


}




?>