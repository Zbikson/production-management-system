<div class="sidebar">
    <h1>PMS</h1>

    <ol>
        <li><i class="bi bi-collection"></i> Zlecenia</li>
            <ul>
                <a href="index.php?action=dashboard-main"><li>Do realizacji</li></a>
                <li>Zrealizowane</li>
            </ul>
    </ol>

</div>


<div class="content">

<div class="header">
    <div class="title">Panel zleceń</div>

    <div class="data">
        <?php
        if(isset($_SESSION['username']) && isset($_SESSION['name']) && isset($_SESSION['lastname'])){
            echo "Użytkownik: " . $_SESSION['username'] . " • ";
            echo "Imię: " . $_SESSION['name'] . " • ";
            echo "Nazwisko: " . $_SESSION['lastname'] . "<br>";
            echo "Data: ". date('d/m/Y') . " • "; 
            echo "Godzina: ". date(' H:i');
        }
        ?>
    </div>

    <div class="control-panel">
        <?php
        if($_SESSION['role'] == 'admin'){
            echo '<a id="panel-btn" href="index.php?action=list-order" title="Panel zleceń"><i class="bi bi-terminal"></i>Panel administratora</a>';
        } else{
            echo '<a id="panel-disable" href="index.php?action=list-order" title="Panel zleceń">Panel administratora</a>';
        }
        ?>
        
        <a id="logout-btn" href="index.php?action=logout" title="Wyloguj"><i class="bi bi-box-arrow-right"></i>Wyloguj</a>
    </div>
</div>