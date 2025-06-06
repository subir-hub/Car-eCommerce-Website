
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
                <div class="card p-3 shadow mt-5" id="signup">
                    <h3 class="text-center mb-4">Signup</h3>
                    <form id="signupForm" method="post" autocomplete="off">
                        <div class="mb-3">
                            <input type="text" name="signupName" id="signupName" class="form-control" placeholder="Enter full name">
                            <p id="signupNameError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="signupEmail" id="signupEmail" class="form-control" placeholder="Enter your email">
                            <p id="signupEmailError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="signupPassword" id="signupPassword" class="form-control" placeholder="Enter Password">
                            <p id="signupPasswordError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password">
                            <p id="confirmPasswordError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <button type="submit" name="signupButton" id="signupButton" class="btn btn-primary w-100">Submit</button>

                        <div id="signupMsg" class="text-center fw-bold mt-1"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php' ?>

    <script src="./script.js"></script>

</body>

</html>