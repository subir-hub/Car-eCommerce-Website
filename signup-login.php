<?php
session_start();
include '../project/admin/db.php';

// Signup
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'signup') {
    $signupName = $_REQUEST['signupName'];
    $signupEmail = $_REQUEST['signupEmail'];
    $signupPassword = $_REQUEST['signupPassword'];
   
    $checkEmailQuery = "SELECT * FROM user WHERE email = '$signupEmail'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo json_encode(['code' => 400, 'message' => 'You are already registered']);
        exit;
    }
    
    $hashedPassword = password_hash($signupPassword, PASSWORD_BCRYPT);

    // Insert new user
    $insertData = "INSERT INTO user (name, email, password, role) VALUES ('$signupName','$signupEmail','$hashedPassword', 'user')";
    $insertQuery = mysqli_query($conn, $insertData);

    if ($insertQuery) {
        $user_id = mysqli_insert_id($conn); // retrieves the id of the customer who just signed up

        // Auto-login after signup
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['userName'] = $signupName;
        $_SESSION['userEmail'] = $signupEmail;

        echo json_encode(['code' => 200, 'message' => 'Signup successful... Please wait']);
    } else {
        echo json_encode(['code' => 500, 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
    exit;
}

// Login
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'login') {
    $loginEmail = $_REQUEST['loginEmail'];
    $loginPassword = $_REQUEST['loginPassword'];

    $query = "SELECT * FROM user WHERE email = '$loginEmail' AND role = 'user'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); // Get that user's data (like id, name, email, password) from the database.
     
        if (password_verify($loginPassword, $user['password'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $user['id']; 
            $_SESSION['userName'] = $user['name'];
            $_SESSION['userEmail'] = $user['email'];

            echo json_encode(['code' => 200, 'message' => 'Login successful... Please wait']);
        } else {
            echo json_encode(['code' => 400, 'message' => 'Invalid password']);
        }
    } else {
        echo json_encode(['code' => 400, 'message' => 'User not found']);
    }
    exit;
}
