
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './links.php' ?>
</head>

<body>
    <?php include './header.php' ?>
<div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card p-3 shadow mt-5" id="login">
                    <h3 class="text-center mb-4">Login</h3>
                    <form id="loginForm" method="post" autocomplete="off">
                        <div class="mb-3">
                            <input type="email" name="loginEmail" id="loginEmail" class="form-control" placeholder="Enter your email">
                            <p id="loginEmailError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="loginPassword" id="loginPassword" class="form-control" placeholder="Enter Password">
                            <p id="loginPasswordError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <button type="submit" name="loginButton" id="loginButton" class="btn btn-primary w-100">Submit</button>

                        <div id="loginMsg" class="text-center fw-bold mt-1"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php' ?>
</body>

<script src="./script.js"></script>

</html>