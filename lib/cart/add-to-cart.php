<?php

session_start();

include_once("../dbConn.php");
include_once("cart-models.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $total = $quantity * $price;

    add_to_cart($pdo, $product_id, $quantity, $total);

    header("Location: ../../index.php");
}
