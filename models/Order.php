<?php

require_once __DIR__ . '/../models/Database.php';
class Order{

    private $id;
    private $orderNumber;
    private $company;
    private $detail;
    private $quantity;
    private $quantityNow;
    private $issueDate;
    private $executionDate;
    

    public function __construct($orderNumber, $company, $detail, $quantity, $quantityNow, $issueDate, $executionDate){
        $this->orderNumber = $orderNumber;
        $this->company = $company;
        $this->detail= $detail;
        $this->quantity = $quantity;
        $this->quantityNow = $quantityNow;
        $this->issueDate = $issueDate;
        $this->executionDate = $executionDate;
    }

    public function save(){
        $database = new Database();
        $connection = $database->getConnection();

        $stmt = $connection->prepare("INSERT INTO orders (orderNumber, company, detail, quantity, quantityNow, issueDate, executionDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiiss", $this->orderNumber, $this->company, $this->detail, $this->quantity, $this->quantityNow, $this->issueDate, $this->executionDate);
        $stmt->execute();

        $this->id = $connection->insert_id;

        $stmt->close();
    }
    public static function delete($id) {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "DELETE FROM orders WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Logowanie błędu do pliku lub innego systemu logów
            error_log("Błąd usuwania zlecenia: " . $stmt->error);
            
            $stmt->close();
            return false;
        }
    }

    public static function getOrderById($id) {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "SELECT * FROM orders WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        $stmt->close();

        return $order;
    }

    public static function getByOrderName($order) {
        $database = new Database();
        $conn = $database->getConnection();

        // Sprawdzanie połączenia
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM orders WHERE orderNumber = '$order'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $order = new Order($row['orderNumber'], $row['company'], $row['detail'], $row['quantity'], $row['quantityNow'], $row['issueDate'], $row['executionDate']);
            $order->id = $row['id'];
            return $order;
        } else {
            return null;
        }
    }

    public static function update($id, $newOrderNumber, $newCompany, $newDetail, $newQuantity, $newIssueDate, $newExecutionDate) {
        $database = new Database();
        $connection = $database->getConnection();

        $query = "UPDATE orders SET orderNumber = ?, company = ?, detail = ?, quantity = ?, issueDate = ?, executionDate = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssissi", $newOrderNumber, $newCompany, $newDetail, $newQuantity, $newIssueDate, $newExecutionDate, $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    // Status 0 - w trakcie
    // Status 1 - zakończone

    public static function settle($id, $quantityToAdd, $userId) {
        $database = new Database();
        $connection = $database->getConnection();
    
        // Najpierw pobierz aktualną i całkowitą ilość dla zlecenia
        $query = "SELECT quantityNow, quantity FROM orders WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $order = $result->fetch_assoc();
            $currentQuantity = $order['quantityNow'];
            $totalQuantity = $order['quantity'];
    
            $newQuantity = $currentQuantity + $quantityToAdd;
    
            if ($newQuantity <= $totalQuantity) {
                // Aktualizuj ilość w zleceniu
                $updateQuery = "UPDATE orders SET quantityNow = ? WHERE id = ?";
                $updateStmt = $connection->prepare($updateQuery);
                $updateStmt->bind_param("ii", $newQuantity, $id);
                $updateStmt->execute();
                $updateStmt->close();

                        $currentDateTime = date('Y-m-d H:i:s'); // Pobierz aktualną datę i czas
                        $progressQuery = "INSERT INTO user_order_progress (order_id, user_id, completed_quantity, date_completed) VALUES (?, ?, ?, ?)";
                        $progressStmt = $connection->prepare($progressQuery);
                        $progressStmt->bind_param("iiis", $id, $userId, $quantityToAdd, $currentDateTime);
                        $progressStmt->execute();
                        $progressStmt->close();
    
                // Jeśli ilość zadana jest równa ilości wykonanej, uaktualnij status zlecenia
                if ($newQuantity == $totalQuantity) {
                    $updateStatusQuery = "UPDATE orders SET status = 1 WHERE id = ?";
                    $updateStatusStmt = $connection->prepare($updateStatusQuery);
                    $updateStatusStmt->bind_param("i", $id);
                    $updateStatusStmt->execute();
                    $updateStatusStmt->close();             
                    $_SESSION['success_settle_end'] = 'Zlecenie zakończone - przeniesione do "Zlecenia zakończone"!';       
                }
    
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function showOrderDetails($orderId) {
        $database = new Database();
        $connection = $database->getConnection();
    
        $query = "SELECT o.orderNumber, o.orderNumber, uop.user_id, u.username AS user_name, uop.completed_quantity, uop.date_completed
                  FROM user_order_progress uop
                  JOIN users u ON uop.user_id = u.id
                  JOIN orders o ON uop.order_id = o.id
                  WHERE uop.order_id = ?";
    
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Błąd zapytania: " . $connection->error;
            return null;
        }
    }
    
    public static function generateOrderNumber() {
        $currentDateTime = new DateTime();
        return 'ORD-' . $currentDateTime->format('YmdHis') . '-' . rand(100, 999);
    }

}
?>