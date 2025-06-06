<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <?php include 'links.php'; ?>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-3">Your Cart</h2>
        <div class="table-responsive">
            <?php if (empty($_SESSION['cart'])) { ?>
                <p class="alert alert-info text-danger text-center fs-5">Your cart is empty.</p>
            <?php } else { ?>
                <table class="table table-bordered text-center shadow-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;
                        foreach ($_SESSION['cart'] as $index => $item) {
                            $totalPrice = $item['price'] * $item['qty'];
                            $grandTotal += $totalPrice;
                        ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><img src="admin/uploads/<?= $item['image']; ?>" width="80"></td>
                                <td><?= $item['name']; ?></td>
                                <td><?= $item['model']; ?></td>
                                <td><?= $item['color']; ?></td>
                                <td>₹<?= number_format($item['price']); ?></td>
                                <td>
                                    <div class="input-group justify-content-center">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(<?= $index; ?>, <?= $item['qty'] - 1; ?>)">-</button>
                                        <input type="text" class="form-control text-center" value="<?= $item['qty']; ?>" style="width: 60px;" readonly>
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(<?= $index; ?>, <?= $item['qty'] + 1; ?>)">+</button>
                                    </div>
                                </td>
                                <td>₹<?= number_format($totalPrice); ?></td>
                                <td>
                                    <form action="ajax.php" method="POST" onsubmit="return confirmDelete();">
                                        <input type="hidden" name="index" value="<?= $index; ?>">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-light">
                            <td colspan="7" class="text-right"><strong>Grand Total:</strong></td>
                            <td><strong>₹<?= number_format($grandTotal); ?></strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-end">
                                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            <?php } ?>
        </div>
    </div>

    <?php require './footer.php' ?>

    <script>
        function changeQuantity(index, newQty) {
            if (newQty < 1) {
                alert('Quantity cannot be less than 1');
                return;
            }

            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    action: 'updatequantity',
                    index: index,
                    qty: newQty
                },
                dataType: 'json',
                success: function(response) {
                    if (response.code === 200) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this car?");
        }
    </script>
</body>
</html>
