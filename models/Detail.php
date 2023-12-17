<?php
require_once __DIR__ . '/../models/Database.php';

class Detail{
    private $id;
    private $detailName;

    public function __construct($detailName){
        $this->detailName = $detailName;
    }

    public function save(){
        $database = new Database();
        $connection = $database->getConnection();

        $stmt = $connection->prepare("INSERT INTO details (detailName) VALUES (?)");
        $stmt->bind_param("s", $this->detailName);
        $stmt->execute();

        $this->id = $connection->insert_id;

        $stmt->close();
    }

    public static function getByDetailName($detailName) {
        $database = new Database();
        $conn = $database->getConnection();

        // Sprawdzanie połączenia
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM details WHERE detailName = '$detailName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $detail = new Detail($row['detailName']);
            $detail->id = $row['id'];
            return $detail;
        } else {
            return null;
        }
    }

    public static function getDetails() {
        $database = new Database();
        $connection = $database->getConnection();
    
        // Sprawdzenie połączenia
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
    
        $sql = "SELECT id, detailName FROM details";
        $result = $connection->query($sql);
    
        $details = [];
        if ($result->num_rows > 0) {
            // Przechodzenie przez każdy wiersz wyników
            while($row = $result->fetch_assoc()) {
                $details[] = $row;
            }
        }
    
        $connection->close();
        return $details;
    }


}
?>