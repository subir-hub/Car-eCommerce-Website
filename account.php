<?php
session_start();
include '../project/admin/db.php';

// Check if user is logged in
if (!isset($_SESSION['userEmail'])) {
    header("Location: login.php");
    exit;
}

// Secure user_id
$user_id = (int)$_SESSION['userId'];

// Fetch user's orders
$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Order Summary</title>
    <?php include './links.php'; ?>
    <style>
        h2.text-primary {
            font-size: 1.75rem;
        }

        .bg-light {
            transition: background-color 0.3s ease;
        }

        .bg-light:hover {
            background-color: #f8f9fa;
            /* lighter hover effect */
        }
    </style>
</head>

<body>

    <?php include './header.php'; ?>

    <div class="container my-5">

        <div class="p-4 mb-4 bg-light rounded-3 shadow-sm d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="mb-0 text-primary fw-semibold">🧾 Order Summary</h2>
            <div class="text-end mt-2 mt-md-0">
                <span class="text-muted fw-medium">👋 Welcome, <span class="text-dark"><?= $_SESSION['userName']; ?></span></span>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="text-center">
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td>₹<?= $row['price'] ?></td>
                                <?php
                                $status = $row['status'];
                                $badge_class = match ($status) {
                                    'Confirmed' => 'badge bg-success',
                                    'Rejected' => 'badge bg-danger',
                                    'Cancelled' => 'badge bg-secondary',
                                    default => 'badge bg-warning'
                                };
                                ?>
                                <td><span class="<?= $badge_class ?>"><?= $status ?></span></td>
                                <td><?= $row['created_at'] ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger">No orders found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php require './footer.php' ?>

</body>

</html>