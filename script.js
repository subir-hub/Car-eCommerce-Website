$(document).ready(function () {

    $("#signupButton").click(function (e) {
        e.preventDefault();

        $("input").on("keyup", function () {
            $(this).parent().find(".error").text("");
        })

        var signupName = $("#signupName").val();
        var signupEmail = $("#signupEmail").val();
        var signupEmailRegex = /^\S+@\S+\.\S+$/;
        var signupPassword = $("#signupPassword").val();
        var confirmPassword = $("#confirmPassword").val();
        var flag = true;

        if (signupName === "") {
            $("#signupNameError").text("Name is required");
            flag = false;
        }

        if (signupEmail === "" || !signupEmailRegex.test(signupEmail)) {
            $("#signupEmailError").text("Please enter a valid email id");
            flag = false;
        }

        if (signupPassword === "" || signupPassword.length < 6) {
            $("#signupPasswordError").text("Password must be at least 6 characters");
            flag = false;
        }

        if (signupPassword !== confirmPassword) {
            $("#confirmPasswordError").text("Passwords do not match");
            flag = false;
        }

        if (flag) {
            var signupFormData = $("#signupForm").serialize();
            $.ajax({
                url: 'signup-login.php',
                type: 'post',
                data: signupFormData + '&action=signup',
                dataType : 'json',
                success: function (response) {
                    if(response.code === 200) {
                        $("#signupMsg").text(response.message).css("color", "green");

                        setTimeout(function() {
                            window.location.href = 'login.php';
                        },1500)
                    } 
                    
                    if(response.code === 400) {
                        $("#signupMsg").text(response.message).css("color", "red");
                        $("#signupForm")[0].reset();

                        setTimeout(function() {
                            location.reload();
                        },2500)
                    }
                },
                error: function () {
                    $("#signupMsg").text("Something went wrong! Please try again").css("color", "red");
                }
            });
        }
    });
});




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
                url: 'signup-login.php',
                type: 'post',
                data: {
                    loginEmail: loginEmail,
                    loginPassword: loginPassword,
                    action: 'login'
                },
                dataType: 'json',
                success: function(response) {

                    if (response.code === 200) {
                        $("#loginMsg").text(response.message).css("color", "green");
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 1500)
                    }

                    if (response.code === 400) {
                        $("#loginMsg").text(response.message).css("color", "red");

                        $("#loginForm")[0].reset();

                        setTimeout(function() {
                            location.reload();
                        },2500)
                    }
                },
                error: function() {
                    $("#loginMsg").text("Something went wrong! Please try again").css("color", "red");
                }
            });
        }
    });

});

