      <?php
        session_start();
        include '../project/admin/db.php';

        if (!isset($_SESSION['userEmail'])) {
            header("Location: login.php");
            exit;
        }

        $user_id = $_SESSION['userId'];
        $query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        ?>

      <!DOCTYPE html>
      <html lang="en">

      <head>
          <meta charset="UTF-8">
          <title>Order Summary</title>
          <?php include './links.php'; ?>
      </head>

      <body>

          <?php include './header.php' ?>

          <div class="container my-5">
              <h2 class="text-center mb-4">Order Summary</h2>

              <table class="table table-bordered table-hover shadow-sm">
                  <thead class="table-primary">
                      <tr class="text-center">
                          <th>Order ID</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Total Price</th>
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
                                  <td><?= $row['created_at'] ?> </td>
                              </tr>
                          <?php }
                        } else { ?>
                          <tr>
                              <td colspan="6" class="text-center text-danger">No orders found</td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>

              <div class="text-center py-5">
                  <i class="fas fa-check-circle text-success mb-4" style="font-size: 80px;"></i>
                  <h1 class="text-success mb-3" style="font-weight: 700;">Thank You, <?= $_SESSION['userName'] ?>!</h1>
                  <p class="lead mb-4">Your order has been placed <span class="text-primary">successfully</span>! 🎉</p>
                  <p class="text-muted">We’ll get in touch with you shortly with all the order details.</p>
                  <a href="index.php" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Continue Shopping</a>
              </div>

          </div>

          <?php include './footer.php' ?>

      </body>

      </html>