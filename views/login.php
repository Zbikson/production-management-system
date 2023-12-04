<?php
if(!isset($_SESSION)){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/login-style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>Logowanie</h2>
        </div>

        <form class="basic-form" method="post">
            <label>Nazwa użytkownika</label>
            <input type="text" name="username" id="username" required>
            <label>Hasło</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Zaloguj</button>
            <?php
            if(isset($_SESSION['error'])){
                echo '<div class="error">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            } 
            ?>
        </form>
    </div>
</body>
</html>