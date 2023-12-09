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

    <div class="main-content" id="list-employee">
    <h2>Lista użytkowników</h2>
        <?php
        $authController = new AuthController();
        $authController->showUsers();
        ?>
    </div>
</div>

</body>
</html>


