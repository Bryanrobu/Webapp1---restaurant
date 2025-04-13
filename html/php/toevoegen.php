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
    $naam = $_POST["naam"];
    $beschrijving = $_POST["beschrijving"];
    $prijs = $_POST["prijs"];

    $sql = "INSERT INTO gerechten (naam, omschrijving, prijs) VALUES (:name, :description, :price)";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ":name" => $naam,
        ":description" => $beschrijving,
        ":price" => $prijs
    ]);
    header("location: ../admin");
}