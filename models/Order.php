<?php

require_once __DIR__ . '/../includes/Database.php';
class Order{

    private $id;
    private $orderNumber;
    private $company;
    private $detail;
    private $quantity;
    private $issueDate;
    private $excecutionDate;
    

    public function __construct($orderNumber, $company, $detail, $quantity, $issueDate, $excecutionDate){
        $this->orderNumber = $orderNumber;
        $this->company = $company;
        $this->detail= $detail;
        $this->quantity = $quantity;
        $this->issueDate = $issueDate;
        $this->excecutionDate = $excecutionDate;
    }

    public function save(){
        $database = new Database();
        $connection = $database->getConnection();

        $stmt = $connection->prepare("INSERT INTO orders (orderNumber, company, detail, quantity, issueDate, executionDate) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $this->orderNumber, $this->company, $this->detail, $this->quantity, $this->issueDate, $this->excecutionDate);
        $stmt->execute();

        $this->id = $connection->insert_id;

        $stmt->close();
    }
}



?>