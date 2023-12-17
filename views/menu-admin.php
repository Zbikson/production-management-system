<div class="sidebar">
<a href="index.php?action=dashboard-admin" ><h1>PMS</h1></a>
    <ol>
        <li class="menu-item" ><i class="bi bi-collection"></i> Zlecenia
            <ul>
                <a href="index.php?action=add-order" ><li>Dodaj zlecenie</li></a>
                <a href="index.php?action=list-order" ><li>Lista zleceń</li></a>
                <a href="index.php?action=completed-order" ><li>Zakończone zlecenia</li></a>
            </ul>
        </li>
        <li class="menu-item" ><i class="bi bi-people"></i> Pracownicy
            <ul>
                <a href="index.php?action=add-employee" ><li>Dodaj pracownika</li></a>
                <a href="index.php?action=list-employee" ><li>Lista pracowników</li></a>
            </ul>
        </li>
        <li class="menu-item" ><i class="bi bi-gear"></i> Opcje
            <ul>
                <a href="index.php?action=add-detail-view" ><li>Dodaj detale</li></a>
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
            echo "Nazwisko: " . $_SESSION['lastname'] . "<br>";
            echo "Data: ". date('d/m/Y'). " • "; 
            echo "Godzina: ". date(' H:i');
        }
        ?>
    </div>

    <div class="control-panel">
        <a id="panel-btn" href="index.php?action=dashboard-main" title="Panel zleceń"><i class="bi bi-box-seam"></i>Panel zleceń</a>
        <a id="logout-btn" href="index.php?action=logout" title="Wyloguj"><i class="bi bi-box-arrow-right"></i>Wyloguj</a>
    </div>
</div>