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
    default:
        $authController->login();
        break;
}
?>