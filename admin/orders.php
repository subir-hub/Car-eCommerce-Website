<?php
include('header.php');
include './db.php';
include './links.php';

session_start();
?>

<html>

<body class="hold-transition sidebar-mini layout-fixed">
    <style>
        .action-links a, .action-links .btn {
            display: inline-flex;
            text-decoration: none;
            align-items: center;
            padding: 6px 10px;
            border-radius: 6px;
            margin-right: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .action-links a i, .action-links .btn i {
            margin-right: 6px;
        }

        .action-links a:hover, .action-links .btn:hover {
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

    <div class="wrapper">

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
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
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
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

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
                                    <a href="orders.php" class="nav-link active">
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

        <div class="container my-5 text-center">
            <h2 class="mt-5 mb-4">Order Management</h2>
            <table class="table table-bordered table-hover shadow-sm" aria-label="Order Management Table">
                <caption>List of all orders and their statuses.</caption>
                <thead class="table-primary">
                    <tr>
                        <th>#ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT orders.id, orders.status, orders.created_at, user.name, user.email 
                        FROM orders 
                        JOIN user ON orders.user_id = user.id 
                        ORDER BY orders.id DESC";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 0) {
                        echo '<tr><td colspan="6" class="text-center">No orders found.</td></tr>';
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = htmlspecialchars($row['id']);
                            $name = htmlspecialchars($row['name']);
                            $email = htmlspecialchars($row['email']);
                            $status = htmlspecialchars($row['status']);
                            $created = htmlspecialchars($row['created_at']);

                            // Badge class based on status
                            $badge_class = match ($status) {
                                'Confirmed' => 'badge bg-success',
                                'Rejected' => 'badge bg-danger',
                                'Cancelled' => 'badge bg-secondary',
                                default => 'badge bg-warning'
                            };
                    ?>
                            <tr>
                                <td><?= $id ?></td>
                                <td><?= $name ?></td>
                                <td><?= $email ?></td>
                                <td><span class="<?= $badge_class ?>"><?= $status ?></span></td>
                                <td><?= $created ?></td>
                                <td class="action-links">
                                    <!-- <a href="order-details.php?order_id= class="btn btn-info btn-sm"
                                        title="View order details">
                                        <i class="fas fa-eye"></i> View
                                    </a> -->

                                    <?php if ($status == 'Pending') { ?>
                                        <a href="update-order-status.php?order_id=<?= $id ?>&action=confirm"
                                            class="action-confirm" title="Confirm this order">
                                            <i class="fas fa-check-circle"></i> Confirm
                                        </a>
                                        <a href="update-order-status.php?order_id=<?= $id ?>&action=reject"
                                            class="action-reject" title="Reject this order">
                                            <i class="fas fa-times-circle"></i> Reject
                                        </a>
                                        <a href="update-order-status.php?order_id=<?= $id ?>&action=cancel"
                                            class="action-cancel" title="Cancel this order">
                                            <i class="fas fa-ban"></i> Cancel
                                        </a>
                                    <?php } else { ?>
                                        <span class="text-muted">No action</span>
                                    <?php } ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include('footer.php'); ?>
</body>

</html>
