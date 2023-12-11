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
    <link rel="stylesheet" type="text/css" href="bs/bootstrap/css/bootstrap-table.css">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <title>PMS - Lista użytkowników</title>
</head>
<body>

<div class="container">
    
<?php include 'views/menu.php'; ?>

    <div class="main-content" >
    <h2>Edycja użytkownika</h2>
        <!-- W pliku edit-employee.php w folderze views -->
        <form id="edit-employee" action="?controller=AuthController&action=update-employee" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

            <label for="name">Imię:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

            <label for="lastname">Nazwisko:</label>
            <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" required>

            <label for="name">Hasło:</label>
            <input type="text" name="password" value="<?php echo $user['password']; ?>" required>

            <!-- Dodaj inne pola do edycji -->

            <button type="submit" id="submit-btn">Aktualizuj</button>
        </form>

    </div>
</div>

</body>
</html>


