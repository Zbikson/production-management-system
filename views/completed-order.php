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

    <title>PMS - Lista zakończonych zleceń</title>
</head>
<body>

<div class="container">

<?php include 'views/menu-admin.php'; ?>

<div class="main-content" id="list-order">
    <h2>Lista zakończonych zleceń</h2>

    <?php
        if(isset($_SESSION['success_delete_order'])){
            echo "<div class='error'>" . $_SESSION['success_delete_order'] . "</div>" ; 
            unset($_SESSION['success_delete_order']);
        }
        if(isset($_SESSION['success_edit_order'] )){
            echo "<div class='success'>" . $_SESSION['success_edit_order']  . "</div>" ; 
            unset($_SESSION['success_edit_order'] );
        }
        if(isset($_SESSION['error_edit_order'] )){
            echo "<div class='error'>" . $_SESSION['error_edit_order']  . "</div>" ; 
            unset($_SESSION['error_edit_order'] );
        }
    ?>
        
        <div class="table table-striped">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Numer zlecenia</th>
                    <th>Kontrahent</th>
                    <th>Detal</th>
                    <th>Ilość</th>
                    <th>Data wystawienia</th>
                    <th>Data Wykonania</th>
                    <th>Informacje</th>
                    <th>Usuń</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $database = new Database();
                $connection = $database->getConnection();

                $query = "SELECT * FROM orders WHERE status = 1";
                $result = $connection->query($query);

                if ($result) {
                    $orders = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($orders as $i => $order) {
                        echo '<tr>';
                        echo '<td>' . ($i + 1) . '</td>';
                        echo '<td>' . $order['orderNumber'] . '</td>';
                        echo '<td>' . $order['company'] . '</td>';
                        echo '<td>' . $order['detail'] . '</td>';
                        echo '<td>' . $order['quantityNow'] . "/" . $order['quantity'] . '</td>';
                        echo '<td>' . $order['issueDate'] . '</td>';
                        echo '<td>' . $order['executionDate'] . '</td>';
                        echo '<td><a href="?action=info-order&orderId=' . $order['id'] . ' "<button type="button" class="settle-btn" ><i class="bi bi-chevron-right"></i></button></a></td>';
                        echo '<td><a href="?action=delete-order&id=' . $order['id'] . ' " onclick="return confirm(\'Czy na pewno chcesz usunąć to zlecenie?\' );"><button type="button" class="trash-btn" ><i class="bi bi-trash3"></i></button></a></td>';

                    }
                } else {
                    //błąd zapytania
                    echo "Błąd zapytania: " . $connection->error;
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>