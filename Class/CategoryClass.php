

<?php

require_once 'DatabaseClass.php';

class Category
{
    private $conn;
    private $table = 'categories';
    private $id;
    private $name;


    public function __construct($db, $id = null, $name = null)
    {
        $this->conn = $db;
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
        }
    public function setId($new_id){
        $this->id = $new_id;
    }
    public function setName($new_name){
        $this->name = $new_name;
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = new self($this->conn); // Create a new instance of Category
            $category->setId($row['id']);
            $category->setName($row['name']);
            $categories[] = $category;
        }
        return $categories;
    }


    public function createCategory($name, $description = null)
    {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function updateCategory($id, $name, $description = null)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deleteCategory($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
