<?php 
require_once 'models/Order.php';
require_once __DIR__ . '/../includes/Database.php';

class OrderController{

    public function addOrder(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $orderNumber = $_POST['order-number'];
            $company = $_POST['company'];
            $detail = $_POST['detail'];
            $quantity = $_POST['quantity'];
            $issueDate = $_POST['issue-date'];
            $executionDate = $_POST['execution-date'];

            $newOrder = new Order($orderNumber, $company, $detail, $quantity, $issueDate, $executionDate);

            $newOrder->save();
            header('Location: index.php?action=add-order');
            $_SESSION['success_add_order'] = 'Dodano zlecenie!';
        }
    }

public function completedOrderView() {
    include 'views/completed-order.php';
}

public function addOrderView() {
    include 'views/add-order.php';
}

public function listOrderView() {
    include 'views/list-order.php';
}


}




?>