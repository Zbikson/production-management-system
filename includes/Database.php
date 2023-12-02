<?php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database_name = 'pms';
    private $conn;

    // Konstruktor - tworzy połączenie z bazą danych
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database_name);

        // Sprawdzanie połączenia
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Pobierz połączenie z bazą danych
    public function getConnection() {
        return $this->conn;
    }

    // Zamknij połączenie z bazą danych
    public function closeConnection() {
        if ($this->conn && $this->conn->ping()) {
            $this->conn->close();
            $this->conn = null; // Ustaw połączenie na null, aby uniknąć przypadkowego ponownego zamknięcia
        }
    }
}

?>
