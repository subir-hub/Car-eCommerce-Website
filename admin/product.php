<?php
include('header.php');
include './db.php';
include './links.php';
?>

<html>

<body class="hold-transition sidebar-mini layout-fixed">

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
  </div>


    <div class="container mt-5">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-4">
          <div class="card shadow p-3">
            <h3 class="text-center mb-4">Product Details</h3>
            <form id="myCart" method="post" autocomplete="off" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" name="productName" id="productName" class="form-control" placeholder="product Name">
                <p id="productNameError" class="error text-center text-danger mt-1"></p>
              </div>

              <div class="mb-3">
                <label for="productImage" class="ms-1 mb-2">
                  Select a product :
                </label>

                <input type="file" class="form-control" name="myFile" id="myFile">
                <p id="myFileError" class="error text-center text-danger mt-1"></p>
              </div>

              <div class="mb-3">
                <input type="text" name="model" id="model" class="form-control" placeholder="Product Model">
                <p id="modelError" class="error text-center text-danger mt-1"></p>
              </div>

              <div class="mb-3">
                <input type="text" name="colour" id="colour" class="form-control" placeholder="Product colour">
                <p id="colourError" class="error text-center text-danger mt-1"></p>
              </div>

              <div class="mb-3">
                <input type="text" name="price" id="price" class="form-control" placeholder="Product Price">
                <p id="priceError" class="error text-center text-danger mt-1"></p>
              </div>

              <!-- <div class="mb-3">
                <input type="number" name="qty" id="qty" class="form-control" placeholder="Product Quantity" min="1" max="5">
                <p id="qtyError" class="error text-center text-danger mt-1"></p>
              </div> -->

              <button type="submit" name="btn" id="btn" class="btn btn-primary w-100">Submit</button>

              <div id="responseMsg" class="text-center fw-bold"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container my-5 text-center">
      <h3 class="mt-5 mb-4">Product Data</h3>

      <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
          <thead class="table-dark">
            <tr>
              <th>id</th>
              <th>name</th>
              <th>model</th>
              <th>color</th>
              <th>price</th>
              <th>image</th>
              <!-- <th>quantity</th> -->
              <th colspan="2">operation</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $sql = "SELECT * FROM `products`";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) > 0) {
              while ($res = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                  <td><?= $res['id'] ?></td>
                  <td><?= $res['name'] ?></td>
                  <td><?= $res['model'] ?></td>
                  <td><?= $res['color'] ?></td>
                  <td>₹<?= $res['price'] ?></td>
                  <td><?= $res['image'] ?></td>
                  <td>
                    <a href="./update.php?updateid=<?= $res['id'] ?>">
                      <i class="fa-solid fa-edit" aria-hidden="true" style="color: green;"></i>
                    </a>
                  </td>
                  <td>
                    <a href="#" onclick="deleteRecord(<?= $res['id'] ?>)">
                      <i class="fa-solid fa-trash" aria-hidden="true" style="color: red;"></i>
                    </a>
                  </td>
                </tr>
              <?php
              }
            } else {
              ?>
              <tr>
                <td colspan="7" class="text-danger">No records found.</td>
              </tr>
          </tbody>
        <?php } ?>
        </table>
      </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
      function deleteRecord(id) {
        if (confirm("Are you sure you want to delete this record?")) {
          $.ajax({
            type: "post",
            url: "ajax.php",
            data: {
              delete_id: id,
              action: 'delete'
            },
            dataType: 'json',
            success: function(response) {
              if (response.code === 200) {
                location.reload();
              }
            }
          });
        }
      }
    </script>

    <script src="./script.js"></script>
</body>
<html>