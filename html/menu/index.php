<?php
session_start();
$is_logged_in = $_SESSION["logged_in"] ?? false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Spicy bite</title>
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

    <?php

    include("../process/db.php");

    $db = new db();

    $conn = $db->get_connection();

    $result = [];

    $sql = "SELECT * FROM gerechten";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $search = "%" . $_POST["search"] . "%";
        $sql = "SELECT * FROM gerechten WHERE naam LIKE :search";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['search' => $search]);
        $result = $stmt->fetchAll();
    }
    

    $template = '
    <div class="gerecht-item space-between column">
        <div>
            <h1 class="gerecht-naam">%s</h1>
            <h2 class="gerecht-beschrijving">%s</h2>
        </div>
        <h2 class="gerecht-prijs">€%s</h2>
    </div>
    ';
    ?>

    <form method="POST" action="index.php" class="zoekbox column">
        <input type="text" name="search" class="filteren">
        <button type="submit" class="zoeken">Zoeken</button>
    </form>


    <section class="generale-spacer row">
        <?php
        foreach ($result as $row) {
            echo sprintf($template, $row["naam"], $row["omschrijving"], $row["prijs"]);
        }
        ?>
    </section>




</body>

</html>