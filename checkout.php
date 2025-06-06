<?php
session_start();

if (!isset($_SESSION['userEmail'])) {
    echo "<script>
        alert('First login to proceed to checkout.');
        window.location.href = 'login.php';
    </script>";
    exit;
}
?>
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
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-4 p-4">
                    <h3 class="mb-4 text-center">Checkout</h3>

                    <form id="checkoutForm" autocomplete="off">
                        <div class="mb-3">
                            <label for="name" class="form-label ms-1" style="font-weight: 500;">Full Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="<?= $_SESSION['userName'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label ms-1" style="font-weight: 500;">Email address</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="<?= $_SESSION['userEmail'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label ms-1" style="font-weight: 500;">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label ms-1" style="font-weight: 500;">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
                        </div>

                        <button type="submit" id="confirmOrder" class="btn btn-primary w-100">
                            Confirm Order
                        </button>
                    </form>

                    <div id="checkoutMsg" class="mt-3 text-center fw-bold"></div>
                </div>

            </div>
        </div>
    </div>

    <?php include './footer.php' ?>

</body>

</html>


<script>
    $("#checkoutForm").on("submit", function(e) {
        e.preventDefault();

        var formData = $(this).serialize() + "&action=confirmOrder";

        $.ajax({
            url: 'place-order.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.code === 200) {
                    $("#checkoutMsg").text(response.message).css("color", "green");
                    setTimeout(() => window.location.href = 'order-success.php', 2000);
                } else {
                    $("#checkoutMsg").text(response.message).css("color", "red");
                }
            },

            error: function() {
                $("#checkoutMsg").text("Something went wrong. Try again.").css("color", "red");
            }
        });
    });
</script>