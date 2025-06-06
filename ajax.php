<?php
session_start();
include '../project/admin/db.php';

// Handle Add to Cart
if (isset($_REQUEST['action']) && $_REQUEST['action'] === "addtocart") {
    $product_id = $_REQUEST['product_id'];
    $image = $_REQUEST['image'];
    $name = $_REQUEST['name'];
    $model = $_REQUEST['model'];
    $color = $_REQUEST['color'];
    $price = $_REQUEST['price'];
    $qty = (int)$_REQUEST['qty'];

    if ($name) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        foreach ($_SESSION['cart'] as $index => $cartItem) {
            if ($cartItem['product_id'] === $product_id) {
                // Product already in cart
                echo json_encode([
                    'code' => 409, 
                    'count' => count($_SESSION['cart']), 
                    'message' => 'Product already added to the cart'
                ]);
                exit;
            }
        }

        // If product is not in the cart, add it
        $item = [
            'product_id' => $product_id,
            'image' => $image,
            'name' => $name,
            'model' => $model,
            'color' => $color,
            'price' => $price,
            'qty' => $qty
        ];
        $_SESSION['cart'][] = $item;

        echo json_encode(['code' => 200, 'count' => count($_SESSION['cart']), 'message' => 'Product added to the cart']);
    }
    exit;
}
// Handle Update Quantity
if (isset($_REQUEST['action']) && $_REQUEST['action'] === "updatequantity") {
    $index = $_REQUEST['index'];
    $qty = (int)$_REQUEST['qty'];

    if (isset($_SESSION['cart'][$index])) {
        if ($qty > 0) {
            $_SESSION['cart'][$index]['qty'] = $qty;
            echo json_encode(['code' => 200, 'message' => 'Quantity updated']);
        } else {
            echo json_encode(['code' => 400, 'message' => 'Quantity must be at least 1']);
        }
    } else {
        echo json_encode(['code' => 404, 'message' => 'Item not found']);
    }
    exit;
}

// Handle Remove Item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: cart.php");
    exit();
}
