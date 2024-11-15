<?php

function render_errors()
{

    if (isset($_SESSION["signup_errors"])) {
        $errors = $_SESSION["signup_errors"];

        echo "<div class='error-container'>";
        foreach ($errors as $error) {
            echo "<p class='error'>" . $error . "</p>";
        }
        echo "</div>";

        unset($_SESSION["signup_errors"]);
    }
}
