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

    <title>PMS - Dodaj detale</title>
</head>
<body>

<div class="container">

<?php include 'views/menu-admin.php'; ?>

<div class="main-content" id="add-order">
<h2>Dodaj detal</h2>

    <?php 
        if(isset($_SESSION['success_detail'])){
            echo "<div class='success'>" . $_SESSION['success_detail'] . "</div>";
            unset($_SESSION['success_detail']);
        }
        if(isset($_SESSION['error_detail'])){
            echo "<div class='error'>" . $_SESSION['error_detail'] . "</div>";
            unset($_SESSION['error_detail']);
        }
    ?>
    <form id="add-detail-form" action="?controller=DetailController&action=add-detail" method="post">
        <label for="detail-name">Nazwa detalu </label>
            <input type="text" name="detail-name" id="detail-name" required>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>

</div>

</body>
</html>