<?php
require_once '../Class/DatabaseClass.php';

$database = new Database();
$db = $database->connect();

header('Content-Type: application/json');

$selectedCategory = $_POST['category'] ?? 'all';
$selectedStatus = $_POST['filtrage'] ?? 'all';

// Base query with JOIN to fetch category name
$query = "SELECT books.*, categories.name AS category 
          FROM books 
          JOIN categories ON books.category_id = categories.id 
          WHERE 1=1";

// Add filters if not 'all'
if ($selectedCategory !== 'all') {
    $query .= " AND categories.name = :category";
}
if ($selectedStatus !== 'all') {
    $query .= " AND books.status = :status";
}

// Prepare and execute the query
$stmt = $db->prepare($query);

if ($selectedCategory !== 'all') {
    $stmt->bindParam(':category', $selectedCategory);
}
if ($selectedStatus !== 'all') {
    $stmt->bindParam(':status', $selectedStatus);
}

$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($books);
?>