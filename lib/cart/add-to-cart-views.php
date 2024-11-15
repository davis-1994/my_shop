<?php

function render_message()
{
    if (isset($_SESSION["cart_success_message"])) {
        echo "<div class='success-container'><p class='success'>" . $_SESSION["cart_success_message"] . "</p></div>";

        unset($_SESSION["cart_success_message"]);
    }

    if (isset($_SESSION["cart_errors"])) {

        echo "<div class='error-container' style='text-align: center'>";
        echo "<p class='error'>" . $_SESSION["cart_errors"] . "</p>";
        echo "</div>";

        unset($_SESSION["cart_errors"]);
    }
}
