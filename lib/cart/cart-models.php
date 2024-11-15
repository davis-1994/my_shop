<?php

declare(strict_types=1);

function add_to_cart(object $pdo, int $id, int $quantity, float $total): void
{
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];

        $query = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $pdo->prepare($query);

        $stmt->bindparam("user_id", $user_id);
        $stmt->bindparam("product_id", $id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $query = "UPDATE cart SET quantity = quantity + :quantity, price = price + :price WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $pdo->prepare($query);

            $stmt->bindparam("user_id", $user_id);
            $stmt->bindparam("product_id", $id);
            $stmt->bindparam("quantity", $quantity);
            $stmt->bindparam("price", $total);

            $stmt->execute();

            $_SESSION['cart_success_message'] = "Product added to cart";

            header("Location: ../../index.php");
        } else {

            $query = "INSERT INTO cart (user_id, product_id, quantity, price) VALUES (:user_id, :product_id, :quantity, :price)";
            $stmt = $pdo->prepare($query);

            $stmt->bindparam("user_id", $user_id);
            $stmt->bindparam("product_id", $id);
            $stmt->bindparam("quantity", $quantity);
            $stmt->bindparam("price", $total);

            $stmt->execute();

            header("Location: ../../index.php");
        }
    } else {

        $_SESSION['cart_errors'] = "You must be logged in to add to cart";

        header("Location: ../../login.php");
    }
}

function delete_from_cart(object $pdo, int $id)
{
    $query = "DELETE FROM cart WHERE id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->bindparam("id", $id);

    $stmt->execute();

    $_SESSION['cart_success_message'] = "Product deleted from cart";

    header("Location: ../../index.php");
}
