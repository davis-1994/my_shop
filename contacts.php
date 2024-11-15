<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="global.css">
</head>

<body>

    <?php
    include('components/header.php');
    include('lib/dbConn.php');
    include('lib/contacts/contact-model.php');
    ?>

    <main class="contacts">
        <h3>Contact us</h3>
        <p>For questions, please use the form below.</p>

        <?php
        $name = $email = $message = "";
        $nameErr = $emailErr = $messageErr = $successMsg = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required!";
            } else {
                $name = htmlspecialchars($_POST["name"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required!";
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email is invalid!";
            } else {
                $email = htmlspecialchars($_POST["email"]);
            }

            if (empty($_POST["message"])) {
                $messageErr = "Message is required!";
            } else {
                $message = htmlspecialchars($_POST["message"]);
            }

            if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
                $successMsg = "Thank you! Your message has been sent.";

                contact_us($name, $email, $message, $pdo);

                $name = $email = $message = "";
            }
        }
        ?>

        <?php if (!empty($successMsg)) : ?>
            <div class="alert alert-success"><?php echo $successMsg; ?></div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control <?php echo !empty($nameErr) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $name; ?>">
                <div class="invalid-feedback"><?php echo $nameErr; ?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?php echo !empty($emailErr) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $email; ?>">
                <div class="invalid-feedback"><?php echo $emailErr; ?></div>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea rows="5" class="form-control <?php echo !empty($messageErr) ? 'is-invalid' : ''; ?>" id="message" name="message"><?php echo $message; ?></textarea>
                <div class="invalid-feedback"><?php echo $messageErr; ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </main>

    <?php include('components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>