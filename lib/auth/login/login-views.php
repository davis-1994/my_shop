<?php

function render_message()
{
    if (isset($_SESSION["success_message"])) {
        echo "<div class='success-container'><p class='success'>" . $_SESSION["success_message"] . "</p></div>";

        unset($_SESSION["success_message"]);
    }

    if (isset($_SESSION["login_errors"])) {
        $errors = $_SESSION["login_errors"];

        echo "<div class='error-container'>";
        foreach ($errors as $error) {
            echo "<p class='error'>" . $error . "</p>";
        }
        echo "</div>";

        unset($_SESSION["login_errors"]);
    }
}
