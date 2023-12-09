<?php
session_start();

require_once 'controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$authController = new AuthController();

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
    case 'add-order':
        $authController->addOrder();
        break;
    case 'add-employee':
        $authController->addEmployee();
        break;
    case 'list-order':
        $authController->listOrder();
        break;
    default:
        $authController->login();
        break;
}
?>