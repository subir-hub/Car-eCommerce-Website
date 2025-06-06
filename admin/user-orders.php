<?php
include './db.php';
include './links.php';
include('header.php');

?>

<html>
<style>
    .action-links a {
        display: inline-flex;
        text-decoration: none;
        align-items: center;
        padding: 6px 10px;
        border-radius: 6px;
        margin-right: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .action-links a i {
        margin-right: 6px;
    }

    .action-links a:hover {
        text-decoration: none;
        transform: scale(1.05);
    }

    .action-confirm {
        color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }

    .action-confirm:hover {
        background-color: rgba(40, 167, 69, 0.2);
    }

    .action-reject {
        color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .action-reject:hover {
        background-color: rgba(220, 53, 69, 0.2);
    }

    .action-cancel {
        color: #6c757d;
        background-color: rgba(108, 117, 125, 0.1);
    }

    .action-cancel:hover {
        background-color: rgba(108, 117, 125, 0.2);
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="logout.php" class="nav-link">Logout</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                Products
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="product.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="orders.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Orders</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="customers.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Customer List</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


    <?php

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $user_sql = "SELECT * FROM user WHERE id = $user_id";
        $user_result = mysqli_query($conn, $user_sql);
        $user = mysqli_fetch_assoc($user_result);

        $order_sql = "SELECT p.name, p.price, o.id, o.created_at, o.status, o.quantity 
                  FROM orders o 
                  INNER JOIN products p 
                  ON o.product_id = p.id 
                  WHERE o.user_id = $user_id ORDER BY o.created_at DESC";
        $order_result = mysqli_query($conn, $order_sql);

        $grandTotal = 0;
    }
    ?>

    <div class="container my-5 text-center">
        <h3 class="mb-4">Orders for <?= htmlspecialchars($user['name']) ?> (<?= $user['email'] ?>)</h3>

        <a href="customers.php" class="btn btn-secondary mb-3">Back to Customer List</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (mysqli_num_rows($order_result) > 0) { ?>
                        <?php while ($order = mysqli_fetch_assoc($order_result)) {
                            $totalPrice = $order['price'] * $order['quantity'];
                            $grandTotal += $totalPrice;
                        ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['name'] ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td>₹<?= $totalPrice ?></td>
                                <?php
                                $status = $order['status'];
                                $badge_class = match ($status) {
                                    'Confirmed' => 'badge bg-success',
                                    'Rejected' => 'badge bg-danger',
                                    'Cancelled' => 'badge bg-secondary',
                                    default => 'badge bg-warning'
                                };
                                ?>
                                <td><span class="<?= $badge_class ?>"><?= $status ?></span></td>
                                <td><?= $order['created_at'] ?></td>
                                <td>
                                    <?php if ($order['status'] == 'Pending') { ?>
                                        <div class="action-links">
                                            <a href="update-order-status.php?order_id=<?= $order['id'] ?>&action=confirm" class="action-confirm">Confirm</a>
                                            <a href="update-order-status.php?order_id=<?= $order['id'] ?>&action=reject" class="action-reject">Reject</a>
                                            <a href="update-order-status.php?order_id=<?= $order['id'] ?>&action=cancel" class="action-cancel">Cancel</a>
                                        </div>

                                    <?php } else { ?>
                                       <span class="text-muted">No action</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-danger text-center">No orders found for this user.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include './footer.php' ?>

</body>