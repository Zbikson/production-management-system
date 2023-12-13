<?php

require_once __DIR__ . '/../includes/Database.php';
class Order{

    private $id;
    private $orderNumber;
    private $company;
    private $detail;
    private $quantity;
    private $issueDate;
    private $executionDate;
    

    public function __construct($orderNumber, $company, $detail, $quantity, $issueDate, $executionDate){
        $this->orderNumber = $orderNumber;
        $this->company = $company;
        $this->detail= $detail;
        $this->quantity = $quantity;
        $this->issueDate = $issueDate;
        $this->executionDate = $executionDate;
    }

    public function save(){
        $database = new Database();
        $connection = $database->getConnection();

        $stmt = $connection->prepare("INSERT INTO orders (orderNumber, company, detail, quantity, issueDate, executionDate) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $this->orderNumber, $this->company, $this->detail, $this->quantity, $this->issueDate, $this->executionDate);
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

}
?>