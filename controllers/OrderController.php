<?php 
require_once 'models/Order.php';
require_once __DIR__ . '/../models/Database.php';

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

    public function deleteOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete-order' && isset($_GET['id'])) {
            $id = $_GET['id'];

            if (Order::delete($id)) {
                // Pomyślnie usunięto użytkownika
                $_SESSION['success_delete_order'] = 'Usunięto zlecenie!';
                
            } else {
                // Obsłuż błąd usuwania
                $_SESSION['error_delete_order'] = 'Błąd usuwania zlecenia';
            }

            header("Location: index.php?action=list-order");
            exit();
        }
    }

    public function editOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
            $orderId = $_GET['id'];
            // Pobierz dane użytkownika do edycji
            $order = Order::getOrderById($orderId);

            if (!$order) {
                // Obsłuż przypadki, gdy zlecenie o danym ID nie istnieje
                $_SESSION['error_edit'] = 'Nie znaleziono zlecenia do edycji.';
                header("Location: index.php?action=list-order");
                exit();
            }
            include 'views/edit-order.php';
        } else {
            header("Location: index.php?action=list-order");
            exit();
        }
    }

    public function updateOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['id'];
            $newOrderNumber = $_POST['orderNumber'];
            $newCompany = $_POST['company'];
            $newDetail = $_POST['detail'];
            $newQuantity = $_POST['quantity'];
            $newIssueDate = $_POST['issueDate'];
            $newExecutionDate = $_POST['executionDate'];

            // Wywołaj funkcję do aktualizacji danych zlecenia
            if (Order::update($orderId, $newOrderNumber, $newCompany, $newDetail, $newQuantity, $newIssueDate, $newExecutionDate)) {
                $_SESSION['success_edit_order'] = 'Zaktualizowano zlecenie!';
            } else {
                $_SESSION['error_edit_order'] = 'Błąd podczas aktualizacji danych zlecenia!';
            }
        }
        header("Location: index.php?action=list-order");
        exit();
    }

    public function seetleOrder(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $quantityNow = $_POST['quantityNow'];
            $id = $_POST['id'];
            
            if (Order::settle($id, $quantityNow)) {
                $_SESSION['success_settle'] = 'Rozliczono zlecenie!';
            } else {
                $_SESSION['error_settle'] = 'Błąd podczas rozliczania zlecenia!';
            }
        }
        header("Location: index.php?action=dashboard-main");
        exit();
    }

    public function settleOrderView($orderId){
        $database = new Database();
        $connection = $database->getConnection();
    
        // Pobierz dane zlecenia na podstawie przekazanego ID
        $query = "SELECT * FROM orders WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
    
        include 'views/settle-order.php';
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