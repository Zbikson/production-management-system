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
    <script src="../scripts/script.js"></script>

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
                <a href="#" onclick="showContent('edit-order')"><li>Edytuj zlecenie</li></a>
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

<div class="main-content" id="edit-order">
<h2>Edytuj zlecenie</h2>
    <form id="add-order">
        <label for="order-number">Numer zlecenia </label>
            <input type="text" name="order-number" id="order-number" required>

        <label for="company">Firma </label>
            <input type="text" name="company" id="company" required>

        <label for="issue-date">Data wystawienia </label>
            <input type="date" name="issue-date" id="issue-date" value="<?php echo date('Y-m-d'); ?>" requireds>

        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>

<div class="main-content" id="completed-orders">
<h2>Zakończone zlecenia</h2>
    <form id="add-order">
        <label for="order-number">Numer zlecenia </label>
            <input type="text" name="order-number" id="order-number" required>

        <label for="company">Firma </label>
            <input type="text" name="company" id="company" required>

        <label for="issue-date">Data wystawienia </label>
            <input type="date" name="issue-date" id="issue-date" value="<?php echo date('Y-m-d'); ?>" requireds>

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