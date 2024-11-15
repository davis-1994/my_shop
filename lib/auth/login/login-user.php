<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once "../../dbConn.php";
        require_once "../user-models.php";
        require_once "../validator.php";

        $validate_user = new LoginValidator($email, $password, $pdo);
        $validate_user->validate_data();

        $_SESSION["user"] = $validate_user->get_user_data();

        header("Location: ../../../index.php");
        die();
    } catch (PDOException $e) {
        die("Sql query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../../login.php");
    die();
}
