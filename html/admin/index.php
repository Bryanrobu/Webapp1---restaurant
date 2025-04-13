<?php

session_start();

$is_logged_in = $_SESSION["logged_in"] ?? false;

if (!$is_logged_in) {
    die("You dont have permission to view this page");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/style.css">
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
                        echo '<a href="/php/logout.php" class="nav-button">logout</a>';
                    } else {
                        echo '<a href="/login" class="nav-button">login</a>';
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </header>

    <div class="admin-formulieren row">

        <form method="POST" action="/php/toevoegen.php" class="form center column">
            <h1 class="form-text center">Product Toevoegen</h1>
            <label class="form-text">Productnaam:</label>
            <input type="text" name="naam" class="form-box" required>

            <label class="form-text">Beschrijving:</label>
            <textarea name="beschrijving" class="form-box-beschrijving"></textarea>

            <label class="form-text">Prijs (€):</label>
            <input type="number" name="prijs" class="form-box" required>

            <button type="submit" name="toevoegen" class="form-knop">Toevoegen</button>
        </form>

        <form method="POST" action="/php/veranderen.php" class="form center column">
            <h1 class="form-text center">Product Aanpassen</h1>
            <label class="form-text">Product-ID:</label>
            <input type="number" name="id" class="form-box" required>

            <label class="form-text">Productnaam:</label>
            <input type="text" name="naam" class="form-box" required>

            <label class="form-text">Beschrijving:</label>
            <textarea name="beschrijving" class="form-box-beschrijving"></textarea>

            <label class="form-text">Prijs (€):</label>
            <input type="number" name="prijs" class="form-box" required>

            <button type="submit" name="toevoegen" class="form-knop">Aanpassen</button>
        </form>

        <form method="POST" action="/php/verwijderen.php" class="form center column">
            <h1 class="form-text center">Product Verwijderen</h1>
            <label class="form-text">Product-ID:</label>
            <input type="number" name="id" class="form-box" required>

            <button type="submit" name="verwijderen" class="form-knop">Verwijderen</button>
        </form>

    </div>
    <?php
    include("../php/db.php");
    $sql = "SELECT * FROM gerechten";

    $db = new db();

    $conn = $db->get_connection();

    $result = $conn->query($sql);
    $template = '
    <div class="gerecht-item space-between column">
        <div>
            <h1 class="gerecht-id">ID: %s</h1>
            <h1 class="gerecht-naam">%s</h1>
            <h2 class="gerecht-beschrijving">%s</h2>
        </div>
        <h2 class="gerecht-prijs">€%s</h2>
    </div>
    ';
    ?>
    <section class="generale-spacer row">
        <?php
        foreach ($result as $row) {
            echo sprintf($template, $row["id"], $row["naam"], $row["omschrijving"], $row["prijs"]);
        }
        ?>
    </section>
</body>

</html>