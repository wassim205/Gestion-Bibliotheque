<?php
class User {
    private $conn;
    private $table = 'users';
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
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
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
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $isFirstUser = $stmt->fetchColumn() == 0;

        if ($isFirstUser) {
            $this->role = "admin";
            $this->register();
            return;
        }

        $query = "SELECT * FROM {$this->table} WHERE email = :email";
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

        $query = "INSERT INTO {$this->table} (email,name, password ,role) VALUES (:email, :name, :password ,:role)";
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
}
?>

