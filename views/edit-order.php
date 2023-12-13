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

    <script src="javascript/toogleInput.js"></script>

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <title>PMS - Edycja zlecenia</title>
</head>
<body>

<div class="container">
    
<?php include 'views/menu-admin.php'; ?>

    <div class="main-content" >
    <h2>Edycja zlecenia</h2>
        <form id="edit-order" action="?controller=OrderController&action=update-order" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $order['id']; ?>">
            
            <label for="orderNumber">Numer zlecenia</label>
            <input type="text" id="orderNumber" name="orderNumber" value="<?php echo $order['orderNumber']; ?>" required>

            <label for="company">Kontrahent</label>
            <input type="text" id="company" name="company" value="<?php echo $order['company']; ?>"  required>

            <label for="detail">Detal</label>
            <input type="text" id="detail" name="detail" value="<?php echo $order['detail']; ?>" required>

            <label for="quantity">Ilość</label>
            <input type="text" id="quantity" name="quantity" value="<?php echo $order['quantity']; ?>" required>

            <label for="issueDate">Data wystawienia</label>
            <input type="date" id="issueDate" name="issueDate" value="<?php echo $order['issueDate']; ?>" required>

            <label for="executionDate">Data wykonania</label>
            <input type="date" id="executionDate" name="executionDate" value="<?php echo $order['executionDate']; ?>" required>

            <button type="submit" id="submit-btn">Aktualizuj</button>
        </form>

    </div>
    
</div>

</body>
</html>


