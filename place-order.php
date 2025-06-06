<?php
session_start();
include '../project/admin/db.php';

header('Content-Type: application/json');

if (isset($_POST['action']) && $_POST['action'] === 'confirmOrder') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (!isset($_SESSION['userId'])) {
        echo json_encode(['code' => 401, 'message' => 'User not logged in']);
        exit;
    }

    $user_id = $_SESSION['userId'];
    $cartItems = $_SESSION['cart'] ?? [];

    if (empty($cartItems)) {
        echo json_encode(['code' => 400, 'message' => 'Your cart is empty']);
        exit;
    }

    $grandTotal = 0;
    $errors = [];

    foreach ($cartItems as $item) {
        $product_id = $item['product_id'];
        $product_name = $item['name'];
        $quantity = $item['qty'];
        $price = $item['price'];
        $totalPrice = $price * $quantity;
        $grandTotal += $totalPrice;

        $insertOrder = "INSERT INTO orders (user_id, product_id, product_name, quantity, price, phone, address) 
                        VALUES ('$user_id', '$product_id', '$product_name', '$quantity', '$grandTotal', '$phone', '$address')";
        $orderQuery = mysqli_query($conn, $insertOrder);

        if (!$orderQuery) {
            $errors[] = "Error for product ID $product_id: " . mysqli_error($conn);
        }
    }

    if (empty($errors)) {
        unset($_SESSION['cart']); 
        echo json_encode(['code' => 200, 'message' => 'Order placed successfully']);
    } else {
        echo json_encode(['code' => 500, 'message' => implode(', ', $errors)]);
    }

    exit;
}
