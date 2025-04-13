<?php
session_start();
$is_logged_in = $_SESSION["logged_in"] ?? false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <nav class="headbar row center">
            <ul class="nav-list row">
                <li>
                    <a href="/index.php" class="nav-button">Home</a>
                </li>
                <li>
                    <a href="/menu" class="nav-button">Menu</a>
                </li>
            </ul>
            <img class="logo" alt="Spicy bite logo" src="/images/Spicy-bite.png">
            <ul class="nav-list row">
                <li>
                    <a href="/" class="nav-button">contact</a>
                </li>
                <li>
                    <?php
                if ($is_logged_in) {
                    echo '<a href="/admin" class="nav-button">Admin</a>';
                } else {
                    echo '<a href="/login" class="nav-button">login</a>';
                }
                ?>
                </li>
            </ul>
        </nav>
    </header>

    <section class="generale-spacer">
        <form class="login-form column" action="/php/login.php" method="POST">
            <div class="column">
                <h1 class="login-text">User</h1>
                <input type="text" class="login-input" name="username" id="username" required placeholder="Username">
            </div>
            <div class="column">
                <h1 class="login-text">Password</h1>
                <input type="password" class="login-input" name="password" id="password" required
                    placeholder="Password">
            </div>
            <button type="submit" class="submit-login">Login</button>
        </form>
    </section>
</body>

</html>