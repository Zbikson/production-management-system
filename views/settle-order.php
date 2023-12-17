<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['user_id'])){
    header('Location: index.php?action=login');
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

    <div class="detail-info-container">
        <div class="detail-info" id="order-number">
            <b>Numer zlecenia</b><br> <?php echo $order['orderNumber']; ?>
        </div>

        <div class="detail-info" id="company">
            <b>Kontrahent</b><br> <?php echo $order['company']; ?>
        </div>
        
        <div class="detail-info" id="detail">
            <b>Detal</b><br> <?php echo $order['detail']; ?>
        </div>
        
        <div class="detail-info" id="quantity">
            <b>Ilość</b><br> <?php echo  $order['quantityNow'] . "/" . $order['quantity']; ?>
        </div>

        <div class="detail-info" id="issueDate">
            <b>Data wystawienia</b><br> <?php echo $order['issueDate']; ?>
        </div>
        
        <div class="detail-info" id="executionDate">
            <b>Data wykonania</b><br> <?php echo $order['executionDate']; ?>
        </div>
        
    </div>

        <form id="seetle-order" action="?controller=OrderController&action=settle" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $order['id']; ?>">

            <label for="quantityNow" >Wykonana ilość</label>
            <input type="text" id="quantityNow" name="quantityNow" required>


            <button type="submit" id="submit-btn">Rozlicz</button>
        </form>

    </div>
    
</div>

</body>
</html>


