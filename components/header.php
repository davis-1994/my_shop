<header>
    <div class="upper">
        <div class="container">
            <div class="upperLeft">
                <ul>
                    <li>
                        <a href="#">Payment</a>
                    </li>
                    <li>
                        <a href="#">Shipping</a>
                    </li>
                    <li>
                        <a href="#">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="upperRight">
                <ul>
                    <li>
                        <a href="contacts.php">Contact us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav class="container">
        <!-- Logo -->
        <a href="index.php">
            <img class="logo" src="assets/logo.png" alt="Logo" width="50" height="50" />
        </a>

        <!-- Right side -->
        <div class="right">
            <!-- Home -->
            <a href="index.php">
                <img src="assets/home.png" alt="home" width="30" height="30" />
            </a>

            <!-- User -->
            <div class="parent" id="user">

                <img src="assets/user.png" alt="user" width="26" height="30" />

                <div class="child" id="user-menu">
                    <?php
                    if (isset($_SESSION['user'])) {

                        $user = $_SESSION['user'];
                        $first_name = $user['first_name'];
                        $last_name = $user['last_name'];

                        echo <<<HTML
                        <h6>Welcome, $first_name $last_name</h6>
                        <div class="divider"></div>
                        <a href="lib/auth/logout.php">
                            <button class="btn btn-primary">
                                Sign out
                            </button>
                        </a>
                        HTML;
                    } else {
                        echo <<<HTML
                        <a href="login.php">
                            <button class="btn btn-primary">
                                Sign in
                            </button>
                        </a>
                        <div class="divider"></div>
                        <p>Dont't have an account?</p>
                        <a href="register.php">
                            <button class="btn btn-primary">
                                Sign up
                            </button>
                        </a>
                        HTML;
                    }

                    ?>

                </div>
            </div>

            <!-- Cart -->
            <div class="parent" id="cart">

                <img src="assets/cart.png" alt="cart" width="30" height="30" />

                <div class="child" id="cart-menu">
                    <?php include('components/cart.php'); ?>
                </div>

            </div>
        </div>
    </nav>

</header>