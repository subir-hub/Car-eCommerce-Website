<?php
include './db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginEmail = mysqli_real_escape_string($conn, $_POST['loginEmail']);
    $loginPassword = $_POST['loginPassword'];

    $sql = "SELECT * FROM user WHERE email = '$loginEmail' AND role = 'admin'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($loginPassword === $user['password'] || password_verify($loginPassword, $user['password'])) {

            // Login success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['loggedIn'] = true;

            echo json_encode(['code' => 200, 'message' => 'Login successful... Please wait']);
        } else {
            echo json_encode(['code' => 400, 'message' => 'Incorrect password']);
        }
    } else {
        echo json_encode(['code' => 400, 'message' => 'Invalid email or not an admin']);
    }
}
?>
