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

    <title>PMS - Lista pracowników</title>
</head>
<body>

<div class="container">
    
<?php include 'views/menu-admin.php'; ?>

    <div class="main-content" id="list-employee">
    <h2>Lista pracowników</h2>

    <?php
        if(isset($_SESSION['success_delete'])){
            echo "<div class='error'>" . $_SESSION['success_delete'] . "</div>" ; 
            unset($_SESSION['success_delete']);
        }
        if(isset($_SESSION['success_edit'] )){
            echo "<div class='success'>" . $_SESSION['success_edit']  . "</div>" ; 
            unset($_SESSION['success_edit'] );
        }
        if(isset($_SESSION['error_edit'] )){
            echo "<div class='error'>" . $_SESSION['error_edit']  . "</div>" ; 
            unset($_SESSION['error_edit'] );
        }
    ?>
        
        <div class="table table-striped">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Użytkownik</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Hasło</th>
                    <th>Rola</th>
                    <th>Edytuj</th>
                    <th>Usuń</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $database = new Database();
                $connection = $database->getConnection();

                $query = "SELECT * FROM users";
                $result = $connection->query($query);

                if ($result) {
                    $users = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($users as $i => $user) {
                        echo '<tr>';
                        echo '<td>' . ($i + 1) . '</td>';
                        echo '<td>' . $user['username'] . '</td>';
                        echo '<td>' . $user['name'] . '</td>';
                        echo '<td>' . $user['lastname'] . '</td>';
                        echo '<td>' . '***' . '</td>';
                        echo '<td>' . $user['role'] . '</td>';
                        echo '<td><a href="?action=edit-employee&id=' . $user['id'] . '"><button type="button" class="edit-btn"><i class="bi bi-pencil-square"></i></button></a></td>';
                        echo '<td><a href="?action=delete-user&id=' . $user['id'] . ' " onclick="return confirm(\'Czy na pewno chcesz usunąć tego użytkownika?\' );"><button type="button" class="trash-btn" ><i class="bi bi-trash3"></i></button></a></td>';

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

</body>
</html>


