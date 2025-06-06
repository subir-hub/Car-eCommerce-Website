<?php
include './db.php';

$id = $_REQUEST['updateid'];
$updateSql = "SELECT * FROM `products` WHERE id = '$id'";
$updateQuery = mysqli_query($conn, $updateSql);
$result = mysqli_fetch_assoc($updateQuery);
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
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card shadow p-3">
                    <h3 class="text-center mb-4">Update Product Details</h3>
                    <form id="updateForm" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" value="<?= $result['name'] ?>" name="productName" id="productName" class="form-control" placeholder="product Name">
                            <p id="productNameError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <label for="productImage" class="ms-1 mb-2">
                                Current Product :
                            </label>
                            <img src="./uploads/<?= $result['image'] ?>" width="100">
                        </div>

                        <div class="mb-3">
                            <label for="productImage" class="ms-1 mb-2">
                                Select a New Product :
                            </label>

                            <input type="file" class="form-control" name="myFile" id="myFile">
                            <p id="myFileError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="text" value="<?= $result['model'] ?>" name="model" id="model" class="form-control" placeholder="product Model">
                            <p id="modelError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="text" value="<?= $result['price'] ?>" name="price" id="price" class="form-control" placeholder="product Price">
                            <p id="priceError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <div class="mb-3">
                            <input type="text" value="<?= $result['color'] ?>" name="colour" id="colour" class="form-control" placeholder="Product colour">
                            <p id="colourError" class="error text-center text-danger mt-1"></p>
                        </div>

                        <input type="hidden" name="updateid" value="<?= $result['id'] ?>">

                        <button type="submit" name="update" id="update" class="btn btn-primary w-100">Update</button>

                        <div id="updateMsg" class="text-center fw-bold"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col text-center mt-4">
        <a href="./product.php" style="text-decoration: none;">Click here</a> to go to Product Page.
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#update").click(function(e) {
                e.preventDefault();

                var form = $("#updateForm")[0];
                var formData = new FormData(form);
                formData.append('action', 'update');

                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.code === 200) {
                            $("#updateMsg").text(response.message).css("color", "green");
                            setTimeout(function() {
                                window.location.href = 'product.php';
                            }, 1500);
                        } else if (response.code === 500) {
                            $("#updateMsg").text(response.message).css("color", "red");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
</body>