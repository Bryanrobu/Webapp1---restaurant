<?php

session_start();

$is_logged_in = $_SESSION["logged_in"] ?? false;

if (!$is_logged_in) {
    die("You dont have permission to view this page");
}

require_once 'db.php';

$db = new db();
$conn = $db->get_connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $naam = $_POST["naam"];
    $beschrijving = $_POST["beschrijving"];
    $prijs = $_POST["prijs"];

    $sql = "UPDATE gerechten SET naam = ?, omschrijving = ?, prijs = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $naam, $beschrijving, $prijs, $id
    ]);
    header("location: ../admin");
}