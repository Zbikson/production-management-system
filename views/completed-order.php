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

    <title>PMS - Dodaj zlecenie</title>
</head>
<body>

<div class="container">

<?php include 'views/menu.php'; ?>

<div class="main-content" id="completed-orders">
<h2>Zakończone zlecenia</h2>
    <form id="add-order">
        <label for="order-number">Numer zlecenia </label>
            <input type="text" name="order-number" id="order-number" required>

        <label for="company">Firma </label>
            <input type="text" name="company" id="company" required>

        <label for="issue-date">Data wystawienia </label>
            <input type="date" name="issue-date" id="issue-date" value="<?php echo date('Y-m-d'); ?>" required>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>

</div>

</body>
</html>