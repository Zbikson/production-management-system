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

<?php include 'views/menu-admin.php'; ?>

<div class="main-content" id="add-order">
<h2>Dodaj zlecenie</h2>

    <?php 
        if(isset($_SESSION['success_add_order'])){
            echo "<div class='success'>" . $_SESSION['success_add_order'] . "</div>";
            unset($_SESSION['success_add_order']);
        }
        if(isset($_SESSION['error_add_order'])){
            echo "<div class='error'>" . $_SESSION['error_add_order'] . "</div>";
            unset($_SESSION['error_add_order']);
        }

    ?>
    <form id="add-order-form" action="?controller=OrderController&action=add" method="post">

        <label for="order-number">Numer zlecenia (generowany automatcznie)</label>
        <?php $orderNumber = Order::generateOrderNumber(); ?>
        <input type="text" name="order-number" id="order-number" value="<?php echo htmlspecialchars($orderNumber); ?>" required>

        <label for="company">Firma </label>
            <input type="text" name="company" id="company" required>

        <label for="detail">Detal </label>
        <select id="detail" name="detail">
            <?php
            $details = Detail::getDetails();
            foreach ($details as $detail): ?>
                <option value="<?php echo htmlspecialchars($detail['detailName']); ?>">
                    <?php echo htmlspecialchars($detail['detailName']); ?>
                </option>
            <?php endforeach; ?>
        </select>
            
        <label for="quantity">Ilość </label>
            <input type="number" min="1" name="quantity" id="quantity" required>

        <input type="hidden" id="quantity-now" name="quantity-now" value=0>

        <label for="issue-date">Data wystawienia </label>
            <input type="date" name="issue-date" id="issue-date" required>

        <label for="execution-date">Data wykonania </label>
            <input type="date" name="execution-date" id="execution-date" required>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>

</div>

</body>
</html>