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
    
    <title>PMS - Rozliczanie zlecenia</title>
</head>
<body>

<div class="container">
    
<?php include 'views/menu-main.php'; ?>

    <div class="main-content" >
    <h2>Rozliczanie zlecenia</h2>
        <form id="seetle-order" action="?controller=OrderController&action=settle" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $order['id']; ?>">

            <label for="quantityNow" >Wykonana ilość</label>
            <input type="text" id="quantityNow" name="quantityNow" required>
            
            <label for="orderNumber" >Numer zlecenia</label>
            <input type="text" id="orderNumber" name="orderNumber" value="<?php echo $order['orderNumber']; ?>" required disabled>

            <label for="company">Kontrahent</label>
            <input type="text" id="company" name="company" value="<?php echo $order['company']; ?>"  required disabled>

            <label for="detail">Detal</label>
            <input type="text" id="detail" name="detail" value="<?php echo $order['detail']; ?>" required disabled>

            <label for="quantity">Ilość</label>
            <input type="text" id="quantity" name="quantity" value="<?php echo $order['quantity']; ?>" required disabled>

            <label for="issueDate">Data wystawienia</label>
            <input type="date" id="issueDate" name="issueDate" value="<?php echo $order['issueDate']; ?>" required disabled>

            <label for="executionDate">Data wykonania</label>
            <input type="date" id="executionDate" name="executionDate" value="<?php echo $order['executionDate']; ?>" required disabled>

            <button type="submit" id="submit-btn">Rozlicz</button>
        </form>

    </div>
    
</div>

</body>
</html>


