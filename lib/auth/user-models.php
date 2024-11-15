<?php

declare(strict_types=1);

function get_user_email(object $pdo, string $email)
{
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);

    $stmt->bindparam("email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // FETCH_ASSOC
    // $result["id"];
    // $result["email"];

    return $result;
}

function create_user(object $pdo, string $firstName, string $lastName, string $email, string $password)
{
    $query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :password)";

    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindparam("firstName", $firstName);
    $stmt->bindparam("lastName", $lastName);
    $stmt->bindparam("email", $email);
    $stmt->bindparam("password", $hashed_password);

    $stmt->execute();
}
