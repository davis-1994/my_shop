<?php

declare(strict_types=1);

class RegisterValidator
{

    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $confirmPassword;

    private $pdo;

    public function __construct(string $firstName, string $lastName, string $email, string $password, string $confirmPassword, object $pdo)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->pdo = $pdo;
    }

    function validate_data()
    {
        $errors = [];

        if (empty($this->firstName) || empty($this->lastName) || empty($this->email) || empty($this->password) || empty($this->confirmPassword)) {
            $errors["uncomplete_form"] = "Please fill in all the fields!";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email format!";
        }
        if ($this->password !== $this->confirmPassword) {
            $errors["password_mismatch"] = "Passwords do not match!";
        }
        if (strlen($this->password) < 8) {
            $errors["password_too_short"] = "Password must be at least 8 characters!";
        }
        if (!empty(get_user_email($this->pdo, $this->email))) {
            $errors["email_exists"] = "Email already exists!";
        }

        if (!empty($errors)) {
            $_SESSION["signup_errors"] = $errors;
            header("Location: ../../../register.php");
            die();
        }
    }
}

class LoginValidator
{

    private $email;
    private $password;
    private $pdo;

    public function __construct(string $email, string $password, object $pdo)
    {
        $this->email = $email;
        $this->password = $password;
        $this->pdo = $pdo;
    }

    function get_user_data()
    {
        return get_user_email($this->pdo, $this->email);
    }

    function validate_data()
    {
        $errors = [];

        if (empty($this->email) || empty($this->password)) {
            $errors["uncomplete_form"] = "Please fill in all the fields!";
        }

        $user = $this->get_user_data();

        if (!$user) {
            $errors["email_not_found"] = "Email not found!";
        }
        if ($user && !password_verify($this->password, $user["password"])) {
            $errors["invalid_password"] = "Invalid password!";
        }

        if (!empty($errors)) {
            $_SESSION["login_errors"] = $errors;
            header("Location: ../../../login.php");
            die();
        }
    }
}
