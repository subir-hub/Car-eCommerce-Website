<?php 
include './db.php';

// Insert Data
if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'upload') {
    $productName = $_REQUEST['productName'];
    $model = $_REQUEST['model'];
    $colour = $_REQUEST['colour'];
    $price = $_REQUEST['price'];
    // $qty = $_REQUEST['qty'];

    $file = $_FILES['myFile'];
    $fileName = $file['name'];
    $tmp_name = $file['tmp_name'];
    $size = $file['size'];
    $error = $file['error'];

    if($error === 0) {
        $destination = "uploads/" . $fileName;

        if(move_uploaded_file($tmp_name, $destination)) {
           
            $sql = "INSERT INTO products (name, model, color, price, image) VALUES ('$productName', '$model', '$colour', '$price', '$fileName')";
            if(mysqli_query($conn, $sql)) {
                echo json_encode(['code' => 200, 'message' => 'Product uploaded and saved successfully!']);
            } else {
                echo json_encode(['code' => 500, 'message' => 'Database error' . mysqli_error($conn)]);
            }
        } else {
            echo "Failed to move the file";
        }
    } else {
        echo "Error while uploading file";
    }
}

// Update Data
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'update') {
    $id = $_REQUEST['updateid'];
    $name = $_REQUEST['productName'];
    $model = $_REQUEST['model'];
    $price = $_REQUEST['price'];
    $color = $_REQUEST['colour'];
   
    $fileName = '';

    if(isset($_FILES['myFile']) && $_FILES['myFile']['error'] === 0) {
        $file = $_FILES['myFile'];
        $fileName = time() . '_' . basename($file['name']);
        $tmp_name = $file['tmp_name'];

        $destination = 'uploads/' . $fileName;

        if(!move_uploaded_file($tmp_name, $destination)) {
            echo json_encode(['code' => 400, 'message' => 'Failed to upload new image']);
            exit;
        }
    }

    if($fileName) {
        $updateSql = "UPDATE `products` SET `name`='$name',`model`='$model',`color`='$color',`price`='$price',`image`='$fileName' WHERE id = '$id' ";
    } else {
        $updateSql = "UPDATE `products` SET `name`='$name',`model`='$model',`color`='$color',`price`='$price' WHERE id = '$id' ";
    }

    $updateQuery = mysqli_query($conn, $updateSql);

    if($updateQuery) {
        echo json_encode(['code' => 200, 'message' => 'Data updated successfully']);
    } else {
        echo json_encode(['code' => 500, 'message' => 'Database error' . mysqli_error($conn)]);
    }
}


// Delete Data
if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete') {
    $deleteId = $_REQUEST['delete_id'];
     
     $getImageSql = "SELECT image FROM `products` WHERE id = '$deleteId'";
     $getImageQuery = mysqli_query($conn, $getImageSql);
     $imageRow = mysqli_fetch_assoc($getImageQuery);
 
     if ($imageRow && !empty($imageRow['image'])) {
         $imagePath = 'uploads/' . $imageRow['image'];
         
         if (file_exists($imagePath)) {
             unlink($imagePath); 
         }
     }

    $deleteData = "DELETE FROM `products` WHERE id = '$deleteId'";
    $deleteQuery = mysqli_query($conn, $deleteData);

    if($deleteQuery) {
        echo json_encode(['code' => 200]);
    } else {
        echo json_encode(['code' => 500, 'messgae' => 'Database error' . mysqli_error($conn)]);
    }
}
?>