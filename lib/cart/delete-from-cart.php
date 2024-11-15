<?php

session_start();

include_once("../dbConn.php");
include_once("cart-models.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    delete_from_cart($pdo, $id);

    header("Location: ../../index.php");
}
