<?php
require_once __DIR__ . '/../includes/Database.php';

class User{

    private $id;
    private $username;
    private $password;
    private $name;
    private $lastname;
    private $role;

    public function __construct($username, $password, $name, $lastname, $role){
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->role = $role;
    }
    
    public function save(){
        $database = new Database();
        $connection = $database->getConnection();

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->username, $hashedPassword);
        $stmt->execute();

        $this->id = $connection->insert_id;

        $stmt->close();
    }

    public static function getByUsername($username) {
        $database = new Database();
        $conn = $database->getConnection();

        // Sprawdzanie połączenia
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User($row['username'], $row['password'], $row['name'], $row['lastname'], $row['role']);
            $user->id = $row['id'];
            return $user;
        } else {
            return null;
        }
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    // Pobieranie ID użytkownika
    public function getId() { 
        return $this->id;
    }

    public function getUsername() { 
        return $this->username;
    }

    public function getName() { 
        return $this->name;
    }
    public function getLastname() { 
        return $this->lastname;
    }

    public function getRole() { 
        return $this->role;
    }

}

?>