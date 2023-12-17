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
    <title>Panel zleceń</title>
</head>
<body>

<div class="container">

<?php include 'views/menu-main.php'; ?>

<div class="main-content" id="main-dashboard">
        <div id="search-bar">
            <form action="">
                <input type="text" placeholder="Wyszukaj...">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>

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
        if(isset($_SESSION['success_settle'] )){
            echo "<div class='success'>" . $_SESSION['success_settle']  . "</div>" ; 
            unset($_SESSION['success_settle'] );
        }
        if(isset($_SESSION['error_settle'] )){
            echo "<div class='error'>" . $_SESSION['error_settle']  . "</div>" ; 
            unset($_SESSION['error_settle'] );
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
                    <th>Rozlicz</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $database = new Database();
                $connection = $database->getConnection();

                $query = "SELECT * FROM orders";
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
                        echo '<td><a href="?action=settle-order&id=' . $order['id'] . ' "<button type="button" class="settle-btn" ><i class="bi bi-chevron-right"></i></button></a></td>';

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
</div>
</div>


</body>
</html>