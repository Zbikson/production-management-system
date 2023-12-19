<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/DetailController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$authController = new AuthController();
$orderController = new OrderController();
$detailController = new DetailController();

switch($action){
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
    case 'completed-order-main':
        $orderController->completedOrderMainView();
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
    case 'settle-order':
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $orderController->settleOrderView($orderId);
        break;
    case 'settle':
        $orderController->seetleOrder();
        break;
    case 'info-order':
        $orderController->infoOrder();
        break;
    case 'info-order-main':
        $orderController->infoOrderMain();
        break;

    // DetailController
    case 'add-detail-view':
        $detailController->addDetailView();
        break;
    case 'add-detail':
        $detailController->addDetail();
        break;

    // Default
    default:
        $authController->login();
        break;
}
?>