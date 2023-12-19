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
    
    <title>PMS - Informacje zlecenia</title>
</head>
<body>

<div class="container">
    
<?php include 'views/menu-main.php'; ?>

<div class="main-content">
<h2>Informacje o zakończonym zleceniu</h2>
    <?php
        if(isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $users = Order::showOrderDetails($orderId);

            if($users) {
                echo "<h3>Zlecenie numer: " . htmlspecialchars($users[0]['orderNumber']) . "</h3>";

                echo "<div class='table table-striped'>";
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr><th>Użytkownik</th><th>Wykonane sztuki</th><th>Data zakończenia</th></tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user['user_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['completed_quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['date_completed']) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "Brak danych o zleceniu.";
            }
        }
    ?>
</div>
</div>



    
</div>

</body>
</html>


