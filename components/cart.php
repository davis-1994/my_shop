<?php

require_once("lib/dbConn.php");

if (!isset($_SESSION['user'])) {
    echo <<<HTML
        <p>Your need to sign in to add to cart!</p>
        <a href="login.php">
            <button class="btn btn-primary">
                Sign in
            </button>
        </a>
    HTML;
} else {
    $stmt = "SELECT * FROM cart WHERE user_id = :user_id";
    $stmt = $pdo->prepare($stmt);
    $stmt->bindparam("user_id", $_SESSION['user']['id']);
    $stmt->execute();

    $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cartTotal = 0;

    echo <<<HTML
        <h3>Cart:</h3>

        <div class="table-container">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
    HTML;

    if (!empty($cart)) {
        foreach ($cart as $item) {
            $product_id = $item['product_id'];

            $product_json = file_get_contents("https://fakestoreapi.com/products/" . $product_id);
            $product_data = json_decode($product_json, true);

            $productTitle = strlen($product_data['title']) > 10 ? substr($product_data['title'], 0, 10) . "..." : $product_data['title'];

            $cartTotal += $item['price'];


            echo <<<HTML
                <tr>
                    <td>{$productTitle}</td>
                    <td>{$item['quantity']}</td>
                    <td>€{$item['price']}</td>
                    <td>
                    
                    <form action="lib/cart/delete-from-cart.php" method="post">
                        <input type="hidden" name="id" value="{$item['id']}">
                        <button class='table-action'><img src="assets/delete.png" alt="delete" width="20" height="20" /></button>
                    </form>
                    </td>
                </tr>
            HTML;
        }
    }

    echo <<<HTML
            <tr>
                <td><h6>Total</h6></td>
                <td colspan="3">€$cartTotal</td>
        </table>
        </div>
        <a href="checkout.php"><button class="btn btn-primary" style="margin-top: 10px">Checkout</button></a>
    HTML;
}
