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
    <script src="scripts/script.js"></script>

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <title>Panel administratora</title>
</head>
<body>

<div class="container">

<div class="sidebar">
    <h1>PMS</h1>
    <ol>
        <li class="menu-item" ><i class="bi bi-collection"></i> Zlecenia
            <ul>
                <a href="#" onclick="showContent('add-order')"><li>Dodaj zlecenie</li></a>
                <a href="#" onclick="showContent('list-order')"><li>Lista zleceń</li></a>
                <a href="#" onclick="showContent('completed-orders')"><li>Zakończone zlecenia</li></a>
            </ul>
        </li>
        <li class="menu-item" ><i class="bi bi-people"></i> Pracownicy
            <ul>
                <a href="#" onclick="showContent('add-employee')"><li>Dodaj pracownika</li></a>
                <a href="#" onclick="showContent('edit-employees')"><li>Zarządzanie pracownikami</li></a>
                <a href="#" onclick="showContent('list-employees')"><li>Lista pracowników</li></a>
            </ul>
        </li>
        <li class="menu-item" ><i class="bi bi-gear"></i> Opcje
            <ul>
                <a href="#" onclick="showContent('add-processes')"><li>Dodaj procesy</li></a>
                <a href="#" onclick="showContent('company-data')"><li>Dane firmy</li></a>
            </ul>
        </li>
    </ol>
</div>

<div class="content">

<div class="header">
    <div class="title">Panel administratora</div>

    <div class="data">
        <?php
        if(isset($_SESSION['username']) && isset($_SESSION['name']) && isset($_SESSION['lastname'])){
            echo "Użytkownik: " . $_SESSION['username'] . " • ";
            echo "Imię: " . $_SESSION['name'] . " • ";
            echo "Nazwisko: " . $_SESSION['lastname'];
        }
        ?>
    </div>

    <div class="control-panel">
        <a id="panel-btn" href="index.php?action=dashboard-main" title="Panel zleceń"><i class="bi bi-box-seam"></i>Panel zleceń</a>
        <a id="logout-btn" href="index.php?action=logout" title="Wyloguj"><i class="bi bi-box-arrow-right"></i>Wyloguj</a>
    </div>
</div>

<div class="main-content" id="add-order">
<h2>Dodaj zlecenie</h2>
    <form id="add-order">
        <label for="order-number">Numer zlecenia </label>
            <input type="text" name="order-number" id="order-number" required>

        <label for="company">Firma </label>
            <input type="text" name="company" id="company" required>

        <label for="detail">Detal </label>
            <input type="text" name="detail" id="detail" required>
            
        <label for="quantity">Ilość </label>
            <input type="number" min="1" name="quantity" id="quantity" required>

        <label for="execution-date">Data wykonania </label>
            <input type="date" name="execution-date" id="execution-date" required>

        <label for="issue-date">Data wystawienia </label>
            <input type="date" name="issue-date" id="issue-date" value="<?php echo date('Y-m-d'); ?>" requireds>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>

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

<div class="main-content" id="add-employee">
<h2>Dodaj pracownika</h2>
        <?php
        if(isset($_SESSION['success_register'])){
            echo "<div class='success'>" . $_SESSION['success_register'] . "</div>";
            unset($_SESSION['success_register']);
        }
        ?>
    <form id="add-order" action="?controller=AuthController&action=dashboard-admin" method="post">
        <label for="username">Nazwa użytkownika </label>
            <input type="text" name="username" id="username" required>

        <label for="password">Hasło </label>
            <input type="password" name="password" id="password" required>

        <label for="name">Imię </label>
            <input type="text" name="name" id="name" required>

        <label for="lastname">Nazwisko </label>
            <input type="text" name="lastname" id="lastname" required>

        <label for="role">Rola </label>
        <select id="role" name="role">
                    <option value="employee">Pracownik</option>
                    <option value="admin">Administrator</option>
                </select>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>


</div>
</div>

<script>
    function showContent(contentId) {
        // Ukryj wszystkie sekcje treści
        var contentSections = document.querySelectorAll('.main-content');
        contentSections.forEach(function(section) {
            section.style.display = 'none';
        });

        // Pokaż wybraną sekcję treści
        document.getElementById(contentId).style.display = 'block';
    }
</script>
</body>
</html>