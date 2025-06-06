<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <?php include './links.php'; ?>
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .thank-you-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            animation: fadeIn 0.6s ease;
        }
        .thank-you-card h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .thank-you-card p {
            color: #555;
        }
        .thank-you-card .btn {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease;
        }
        .thank-you-card .btn:hover {
            background-color: #0056b3;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="thank-you-card">
        <h3>Thank you, <?= htmlspecialchars($_SESSION['name']) ?>!</h3>
        <p>Your message has been received. We'll get back to you soon.</p>
        <a href="index.php" class="btn mt-3">Go to Home</a>
    </div>
</body>
</html>
