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

    <title>Panel administratora</title>
</head>
<body>

<div class="container">

    <div class="sidebar">
        <h1>PMS</h1>

        <ol>
            <li><i class="bi bi-collection"></i> Zlecenia</li>
                <ul>
                    <a href=""><li>Dodaj zlecenie</li></a>
                    <li>Edytuj zlecenie</li>
                    <li>Dodaj zlecenie</li>
                </ul>
            <li><i class="bi bi-people"></i> Pracownicy</li>
            <ul>
                    <li>Dodaj pracownika</li>
                    <li>Zarządzanie pracownikami</li>
                    <li>Lista pracowników</li>
                </ul>
            <li><i class="bi bi-gear"></i></i> Opcje</li>
            <ul>
                    <li>Dodaj procesy</li>
                    <li>Dane firmy</li>
                </ul>
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
        <a id="panel" href="index.php?action=dashboard-main" title="Panel zleceń"><i class="bi bi-box-seam"></i>Panel zleceń</a>
        <a id="logout" href="index.php?action=logout" title="Wyloguj"><i class="bi bi-box-arrow-right"></i>Wyloguj</a>
    </div>
</div>

<div class="main-content">

    <h2>Dodaj zlecenie</h2>
    <form>
        <label>Kontarhent </label>
        <input type="text" name="contrahent" id="contrahent">
        <label>Data </label>
        <input type="date" name="contrahent" id="contrahent">
        <label>Ilość </label>
        <input type="text" name="contrahent" id="contrahent">
        <button type="submit" id="submit-btn">Dodaj</button>
    </form>
</div>
</div>
</div>


</body>
</html>