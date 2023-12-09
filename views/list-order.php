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

<div class="main-content" id="list-order">
    <div id="search-bar">
        <form action="">
            <input type="text" placeholder="Wyszukaj...">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div id="table">
    <table>
        <thead>
            <tr>
                <th>Lp.</th><th>Numer zlecenia</th><th>Firma</th><th>Detal</th><th>Ilość</th><th>Data wykonania</th><th>Data wystawienia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td><td>Z0001</td><td>Firma A</td><td>NC0001</td><td>10</td><td>2023-01-01</td><td>2023-01-05</td>
            </tr>
            <tr>
                <td>2</td><td>Z0002</td><td>Firma B</td><td>NC0002</td><td>15</td><td>2023-02-10</td><td>2023-02-15</td>
            </tr>
        </tbody>
    </table>

    </div>
</div>

</div>

</body>
</html>