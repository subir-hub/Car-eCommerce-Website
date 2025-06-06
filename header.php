<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fst-italic text-primary fs-3" href="#">
            <img src="./images/vecteezy_automotive-car-logo_10505480.svg" width="80" height="80">
            <span class="text-white">Wheel &</span> Deal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fs-5">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <!-- <i class="fa-solid fa-cart-shopping"></i> Cart -->
                        🛒Cart
                        <span class="badge" id="cart-count">
                            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contact">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5">
                <?php if (isset($_SESSION['userEmail'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="account.php">
                            <i class="fa-regular fa-user fs-5 text-primary"></i>
                            <span>Account</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>


        </div>
    </div>
</nav>