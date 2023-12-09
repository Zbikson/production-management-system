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
            // $password = $user->verifyPassword($password);

            if ($user && $password) { //$user->verifyPassword($password)
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

    public function showUsers(){
        // $database = new Database();
        // $connection = $database->getConnection();

        // $query = "SELECT * FROM users";
        // $result = $connection->query($query);

        // if($result){
        //     $users = $result->fetch_all(MYSQLI_ASSOC);
            
        //     foreach ($users as $i => $user) {
        //         // echo '<a href="index.php?user='. $user['id'] . '">';
        //             echo ($i + 1)  . ' ';
        //             echo $user['username']  . ' ';
        //             echo $user['name']  . ' ';
        //             echo $user['password'] . ' ';
        //             echo $user['lastname'] . ' ';
        //             echo $user['role'] . ' ';
        //         // echo '</a>';
        //     }
        // }else {
        //     // Obsłuż błąd zapytania
        //     echo "Błąd zapytania: " . $connection->error;
        // }
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

    public function listOrder() {
        include 'views/list-order.php';
    }

    public function addOrder() {
        include 'views/add-order.php';
    }

    public function addEmployee() {
        include 'views/add-employee.php';
    }

    public function completedOrder() {
        include 'views/completed-order.php';
    }

    public function logout(){
        session_start();
        session_destroy();
        include 'views/login.php';
    }
}
?>
