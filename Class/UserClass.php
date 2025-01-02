<?php
class User {
    private $conn;
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;

    function __construct($db, $id = null, $name = null, $email = null, $password = null, $role = "user") {
        $this->conn = $db;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    function getId() {
        return $this->id;
    }
    function setId($new_id) {
        $this->id = $new_id;
    }


    function getName() {
        return $this->name;
    }
    function setName($new_name) {
        $this->name = $new_name;
    }


    function getEmail() {
        return $this->email;
    }
    function setEmail($new_email) {
        $this->email = $new_email;
    }


    function getRole() {
        return $this->role;
    }
    function setRole($new_password) {
        $this->role = $new_password;
    }


    function getPassword() {
        return $this->password;
    }
    function setPassword($new_password) {
        $this->password = $new_password;
    }

    public function testConnection() {
        if ($this->conn) {
            echo "Connexion réussie !";
        } else {
            echo "Erreur de connexion.";
        }
    }


    function login() {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            return $user;
        }
        else{
            header('Location: ../login.php?message=identifiants_incorrects');
            exit();
        }
    }


    function registerUser(){
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $isFirstUser = $stmt->fetchColumn() == 0;

        if ($isFirstUser) {
            $this->role = "admin";
            $this->register();
            return;
        }

        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header('Location: ../sign-up.php?error=email_deja_enregistre');
            exit;
        }
        else{
            $this->register();
        }
    }


    function register() {

        $query = "INSERT INTO users (email,name, password ,role) VALUES (:email, :name, :password ,:role)";
        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            header('Location: ../login.php?message=inscription_reussie');
            exit;
        }
        else{
            header('Location: ../sign-up.php?error=erreur_inscription');
            exit;
        }


    }


    function getReservedBooks() {
        $query = "SELECT reservations.id as reservation_id , books.id as book_id ,books.title as title, books.cover_image as cover_image , books.author as author ,reservation_date FROM users INNER JOIN reservations ON users.id = reservations.user_id INNER JOIN books ON reservations.book_id = books.id WHERE users.id = :user_id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in getReservedBooks: " . $e->getMessage());
            return [];
        }
    }

    function getBorrowedBooks() {
        $query = "SELECT borrowings.id as borrowing_id , return_date , books.id as book_id , borrow_date , due_date , books.title as title, books.cover_image as cover_image , books.author as author FROM users INNER JOIN borrowings ON users.id = borrowings.user_id INNER JOIN books ON borrowings.book_id = books.id WHERE borrowings.user_id = :user_id and borrowings.return_date is null";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
        catch (PDOException $e) {
            error_log("Database error in getBorrowedBooks: " . $e->getMessage());
            return [];
        }

    }


    function returnBook($borrowing_id , $book_id){
        // $borrowing_id = (int)$borrow_id;
        // $book_id = (int)$b_id;
        $query = "UPDATE borrowings SET return_date = CURRENT_DATE() WHERE id = :borrowing_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':borrowing_id', $borrowing_id, PDO::PARAM_INT);
        $stmt->execute();

        $query = "UPDATE books SET status = 'available' WHERE id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $query = "SELECT * FROM reservations WHERE book_id = :book_id ORDER BY reservation_date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($reservations) > 0){
            for($i = 0; $i < count($reservations); $i++){
                if($i == 0){
                    $query = "UPDATE books SET status = 'borrowed' WHERE id = :book_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':book_id', $reservations[$i]['book_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    
                    $query = "INSERT into borrowings (user_id , book_id , borrow_date , due_date) VALUES (:user_id , :book_id , CURRENT_DATE() , DATE_ADD(CURRENT_DATE(), INTERVAL 14 DAY))";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':user_id', $reservations[$i]['user_id'], PDO::PARAM_INT);
                    $stmt->bindParam(':book_id', $reservations[$i]['book_id'], PDO::PARAM_INT);
                    var_dump($_SESSION['user_id']);
                    var_dump($reservations[$i]['book_id']);
                    $stmt->execute();
    
                    $query = "DELETE FROM reservations WHERE id = :reservation_id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':reservation_id', $reservations[$i]['id'], PDO::PARAM_INT);
                    $stmt->execute();

                    $this->getReservedBooks();
                    $this->getBorrowedBooks();


                }
            }
        }
            

    
        header('Location: userProfile.php');
        exit;
    }

    function cancelReservation($reservation_id){
        $query = "DELETE FROM reservations WHERE id = :reservation_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reservation_id', $reservation_id, PDO::PARAM_INT);

        $stmt->execute();

        $this->getReservedBooks();
        $this->getBorrowedBooks();

    }
}
?>

