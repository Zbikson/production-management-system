<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['user_id'])){
    header('Location: index.php?action=login');
    exit();
}
if($_SESSION['role'] != 'admin'){
    header('Location: index.php?action=dashboard-main');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/dashboard-style.css">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <title>PMS - Lista użytkowników</title>
</head>
<body>

<div class="container">
    
<?php include 'views/menu.php'; ?>

<div class="main-content" id="add-employee">
<h2>Dodaj pracownika</h2>
        <?php
        if(isset($_SESSION['success_register'])){
            echo "<div class='success'>" . $_SESSION['success_register'] . "</div>";
            unset($_SESSION['success_register']);
        }
        if(isset($_SESSION['bad_username'])){
            echo "<div class='error'>" . $_SESSION['bad_username'] . "</div>";
            unset($_SESSION['bad_username']);
        }
        ?>
    <form id="add-employee-form" action="?controller=AuthController&action=add-employee" method="post">
        <label for="username">Nazwa użytkownika </label>
            <input type="text" name="username" id="username" required>

        <label for="password">Hasło </label>
            <input type="password" name="password" id="password" required>

        <label for="name">Imię </label>
            <input type="text" name="name" id="name" required>

        <label for="lastname">Nazwisko </label>
            <input type="text" name="lastname" id="lastname" required>

        <label for="role">Rola </label>
        <select id="role" name="role">
            <option value="employee">Pracownik</option>
            <option value="admin">Administrator</option>
        </select>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>
</div>

</body>
</html>


