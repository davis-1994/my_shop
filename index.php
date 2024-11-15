<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="global.css">

</head>

<body>

    <?php

    if (isset($_SESSION['price'])) {
        echo $_SESSION['price'];
        unset($_SESSION['price']);
    }

    ?>

    <?php
    $json = file_get_contents("https://fakestoreapi.com/products");
    $dati = json_decode($json, true);
    ?>

    <!-- Header -->
    <?php include('components/header.php'); ?>

    <!-- Success/Error message -->

    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <?php
        require_once("lib/cart/add-to-cart-views.php");

        if (isset($_SESSION['cart_success_message']) || isset($_SESSION['cart_errors'])) {
            render_message();
        }
        ?>
    </div>

    <!-- Main -->
    <main class="container products">

        <?php

        foreach ($dati as $product) {
            $id = $product['id'];
            $title = $product['title'];
            $price = $product['price'];
            $image = $product['image'];

            $formatTitle = strlen($title) > 25 ? substr($title, 0, 25) . "..." : $title;

            echo <<<HTML
                <div class="product">
                    <!-- <a href="product.php?id=$product[id]"> -->
                        <div class="image">
                            <img src="$image" alt="Product" height="100" />
                        </div>
                        <div class="info">
                            <p class="title">
                                $formatTitle
                            </p>
                            <p class="price">€$price</p>
                        </div>
                    <!-- </a> -->
                    <div class="add-to-cart">
                        <form action="lib/cart/add-to-cart.php" method="post">
                            <input type="hidden" name="product_id" value="$id">
                            <input type="hidden" name="price" value="$price">
                            <input type="number" name="quantity" min="1" max="10" value="1">
                            <button class="btn btn-primary" type="submit">Add to cart</button>
                        </form>
                    </div>
                    <div class="overlay"></div>
                </div>
            HTML;
        }
        ?>

    </main>

    <!-- Footer -->
    <?php include('components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>