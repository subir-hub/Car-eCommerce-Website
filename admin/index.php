<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './links.php'; ?>
</head>

<body class="bg-light">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card shadow mt-5" id="login">
                    <div class="card-header bg-primary text-white shadow mb-3">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <form id="loginForm" method="post" autocomplete="off" class="p-3">
                        <div class="mb-3">
                            <input type="email" name="loginEmail" id="loginEmail" class="form-control" placeholder="Enter your email">
                            <p id="loginEmailError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="loginPassword" id="loginPassword" class="form-control" placeholder="Enter Password">
                            <p id="loginPasswordError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <button type="submit" name="loginButton" id="loginButton" class="btn btn-success w-100">Login</button>

                        <div id="loginMsg" class="text-center fw-bold mt-1"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#loginButton").click(function(e) {
                e.preventDefault();

                $("input").on("keyup", function() {
                    $(this).parent().find(".error").text("");
                })

                var loginEmail = $("#loginEmail").val();
                var loginEmailRegex = /^\S+@\S+\.\S+$/;
                var loginPassword = $("#loginPassword").val();
                var isvalid = true;

                if (loginEmail === "" || !loginEmailRegex.test(loginEmail)) {
                    $("#loginEmailError").text("Please enter a valid email id");
                    isvalid = false;
                }

                if (loginPassword === "" || loginPassword.length < 6) {
                    $("#loginPasswordError").text("Password must be at least 6 characters");
                    isvalid = false;
                }

                if (isvalid) {

                    $.ajax({
                        url: 'login.php',
                        type: 'post',
                        data: {
                            loginEmail: loginEmail,
                            loginPassword: loginPassword,
                            // action: 'login'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.code === 200) {
                                $("#loginMsg").text(response.message).css("color", "green");
                               
                                setTimeout(function() {
                                    window.location.href = '../admin/dashboard.php';
                                }, 1500);

                            } else if (response.code === 400) {
                                $("#loginMsg").text(response.message).css("color", "red");
                                $("#loginForm")[0].reset();
                            }
                        },

                        error: function() {
                            $("#loginMsg").text("Something went wrong! Please try again").css("color", "red");
                        }
                    });
                }
            });

        });
    </script>

</body>

</html>