<?php

declare(strict_types=1);

function contact_us($name, $email, $message, $pdo)
{
    $query = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam("name", $name);
    $stmt->bindparam("email", $email);
    $stmt->bindparam("message", $message);
    $stmt->execute();
}
