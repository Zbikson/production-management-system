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

        $stmt = $connection->prepare("INSERT INTO users (username, password, name, lastname, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $this->username, $hashedPassword, $this->name, $this->lastname, $this->role);
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

    public static function deleteUser($id) {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Logowanie błędu do pliku lub innego systemu logów
            error_log("Błąd usuwania użytkownika: " . $stmt->error);
            
            $stmt->close();
            return false;
        }
    }

    public static function getUserById($id) {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();

        return $user;
    }
    
    public static function updateUser($id, $newUsername, $newName, $newLastname, $newPassword, $newRole) {
        $database = new Database();
        $connection = $database->getConnection();

        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE users SET username = ?, name = ?, lastname = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssssi", $newUsername, $newName, $newLastname, $newHashedPassword, $newRole, $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
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

    public function getPassword() { 
        return $this->password;
    }

}

?>