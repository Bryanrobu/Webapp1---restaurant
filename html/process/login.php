<?php

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $db = new db();
    $users = $db->get_users($user);
    
    $row = $users->fetch();
    
    if ($row == null) {
        header("location: /");
        exit;
    }

    if ($user == $row["user"] && $pass == $row["pass"]) {
            session_start();
            $_SESSION["logged_in"] = true;
            header("location: /admin/");
            exit;
        }
}
header("location: /");