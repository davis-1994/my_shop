<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    try {
        require_once "../../dbConn.php";
        require_once "../user-models.php";
        require_once "../validator.php";

        $validate_user_data = new RegisterValidator($firstName, $lastName, $email, $password, $confirmPassword, $pdo);
        $validate_user_data->validate_data();

        create_user($pdo, $firstName, $lastName, $email, $password);

        $_SESSION["success_message"] = "Signup successful! Proceed to login.";

        header("Location: ../../../login.php");
        die();
    } catch (PDOException $e) {
        die("Sql query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../../register.php");
    die();
}
