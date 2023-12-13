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

            if ($user && password_verify($password, $user->getPassword())) {
                // Logowanie udane
                $_SESSION['user_id'] = $user->getId(); // Zapisujemy ID użytkownika w sesji
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['name'] = $user->getName();
                $_SESSION['lastname'] = $user->getLastname();
                $_SESSION['role'] = $user->getRole();

                $redirectUrl = ($_SESSION['role'] != 'admin') ? 'dashboard-main' : 'dashboard-admin';
                header("Location: index.php?action=$redirectUrl");
                exit();

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

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $role = $_POST['role'];

            if (User::getByUsername($username)) {
                $_SESSION['bad_username'] = 'Pracownik o takiej nazwie użytkownika już istnieje!';
                header('Location: index.php?action=add-employee');
            }else{
                // Tworzenie nowego użytkownika
                $newUser = new User($username, $password, $name, $lastname, $role);
                $newUser->save();
                header('Location: index.php?action=add-employee');
                $_SESSION['success_register'] = 'Dodano pracownika!';
                exit();
            }            
        } else {
            // Wyświetlenie formularza rejestracji
            include 'views/login.php';
        }
    }

    public function deleteUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete-user' && isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($id == $_SESSION['user_id']) {
                // Usuń sesję i przekieruj do strony wylogowania
                session_destroy();
                header("Location: index.php?action=logout");
            }

            if (User::deleteUser($id)) {
                // Pomyślnie usunięto użytkownika
                $_SESSION['success_delete'] = 'Usunięto pracownika!';
                
            } else {
                // Obsłuż błąd usuwania
                $_SESSION['error_delete'] = 'Błąd usuwania użytkownika';
            }

            header("Location: index.php?action=list-employee");
            exit();
        }
    }

    public function editEmployee() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
            $userId = $_GET['id'];
            // Pobierz dane użytkownika do edycji
            $user = User::getUserById($userId);

            if (!$user) {
                // Obsłuż przypadki, gdy użytkownik o danym ID nie istnieje
                $_SESSION['error_edit'] = 'Nie znaleziono pracownika do edycji.';
                header("Location: index.php?action=list-employee");
                exit();
            }

            // Wyświetl formularz edycji z wypełnionymi danymi użytkownika
            include 'views/edit-employee.php';
        } else {
            header("Location: index.php?action=list-employee");
            exit();
        }
    }

    public function updateEmployee() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_POST['id'];
            $newUsername = $_POST['username'];
            $newName = $_POST['name'];
            $newLastname = $_POST['lastname'];
            $newPassword = $_POST['password'];
            $newRole = $_POST['role'];

            // Wywołaj funkcję do aktualizacji danych użytkownika
            if (User::updateUser($userId, $newUsername, $newName, $newLastname, $newPassword, $newRole)) {
                $_SESSION['success_edit'] = 'Zaktualizowano dane pracownika!';
            } else {
                $_SESSION['error_edit'] = 'Błąd podczas aktualizacji danych pracownika!';
            }
        }

        // Przekieruj na stronę z listą użytkowników lub inny widok
        header("Location: index.php?action=list-employee");
        exit();
    }


    public function dashboardAdmin() {
        include 'views/dashboard-admin.php';
    }

    public function dashboardMain() {
        include 'views/dashboard-main.php';
    }

    public function listEmployee() {
        include 'views/list-employee.php';
    }

    public function addEmployee() {
        include 'views/add-employee.php';
    }

    public function logout(){
        session_start();
        session_destroy();
        include 'views/login.php';
    }
}
?>
