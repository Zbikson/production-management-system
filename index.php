<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/OrderController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$authController = new AuthController();
$orderController = new OrderController();

switch($action){
    case 'dashboard-admin':
        $authController->dashboardAdmin();
        break;
    case 'dashboard-main':
        $authController->dashboardMain();
        break;
    case 'list-employee':
        $authController->listEmployee();
        break;
    case 'add-employee':
        $authController->addEmployee();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $authController->addUser();
            }
        break;
    case 'delete-user':
        $authController->deleteUser();
        break;
    case 'edit-employee':
        $authController->editEmployee();
        break;
    case 'update-employee':
        $authController->updateEmployee();
        break;


    // OrderController
    case 'add':
        $orderController->addOrder();
        break;
    case 'completed-order':
        $orderController->completedOrderView();
        break;
    case 'list-order':
        $orderController->listOrderView();
        break;
    case 'add-order':
        $orderController->addOrderView();
        break;
    case 'delete-order':
        $orderController->deleteOrder();
        break;
    case 'edit-order':
        $orderController->editOrder();
        break;
    case 'update-order':
        $orderController->updateOrder();
        break;
    // Default
    default:
        $authController->login();
        break;
}
?>