<?php
require_once 'models/User.php';
require_once __DIR__ . '/../includes/Database.php';
class AuthController {
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Weryfikacja użytkownika
            $user = User::getByUsername($username);

            if ($user && $password) { //$user->verifyPassword($password)
                // Logowanie udane
                $_SESSION['user_id'] = $user->getId(); // Zapisujemy ID użytkownika w sesji
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['name'] = $user->getName();
                $_SESSION['lastname'] = $user->getLastname();
                $_SESSION['role'] = $user->getRole();

                if($_SESSION['role'] != 'admin'){
                    header("Location: index.php?action=dashboard-main");
                    exit();
                }else{
                    header("Location: index.php?action=dashboard-admin");
                    exit();
                }

            } else {
                // Logowanie nieudane
                $_SESSION['error'] = 'Nieprawidłowa nazwa użytkownika lub hasło!';
                header("Location: index.php?action=login");
                exit();
            }
        } else {
            // Wyświetlenie formularza logowania
            include 'views/login.php';
        }

    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $role = $_POST['role'];

            // Tworzenie nowego użytkownika
            $newUser = new User($username, $password, $name, $lastname, $role);
            $newUser->save();

            // Rejestracja udana
            // Przekierowanie lub wyświetlenie komunikatu sukcesu
            $_SESSION['success_register'] = 'Zarejestrowano! Możesz się zalogować';
            include 'views/login.php';
            exit();
        } else {
            // Wyświetlenie formularza rejestracji
            include 'views/register.php';
        }
    }

    public function dashboardAdmin() {
        include 'views/dashboard-admin.php';
    }

    public function dashboardMain() {
        include 'views/dashboard-main.php';
    }

    public function logout(){
        session_start();
        session_destroy();
        include 'views/login.php';
    }
}
?>
