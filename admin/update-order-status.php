<?php
include './db.php';

if (isset($_GET['order_id']) && isset($_GET['action'])) {
    $order_id = intval($_GET['order_id']);
    $action = $_GET['action'];

    // Map actions to status
    $valid_actions = [
        'confirm' => 'Confirmed',
        'reject' => 'Rejected',
        'cancel' => 'Cancelled'
    ];

    if (array_key_exists($action, $valid_actions)) {
        $new_status = $valid_actions[$action];

        // Update order status
        $update_sql = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
        $result = mysqli_query($conn, $update_sql);

        if ($result) {
            // Redirect back to the referring page (user orders page)
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Failed to update order status.";
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Missing order_id or action.";
}
?>
