<?php
session_start();
if (!isset($_SESSION['user'])) 
{
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vilnius University - Dashboard</title>
    <style>
        body 
        {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 40px;
        }
        .container 
        {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 
        {
            text-align: center;
            color: #900;
        }
        p 
        {
            font-size: 16px;
            text-align: center;
        }
        .logout-btn 
        {
            display: block;
            margin: 20px auto 0;
            padding: 10px;
            background: #900;
            color: white;
            border: none;
            width: 120px;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vilnius University</h1>
        <h2>Welcome to the Student Portal</h2>
        <p>Hello <strong><?= $user['name'] ?></strong>, you are logged in as <strong><?= $user['role'] ?></strong>.</p>

        <?php if ($user['role'] === 'Admin'): ?>
            <p>🔐 You have administrative access to manage student data.</p>
        <?php else: ?>
            <p>📚 Access your course information and personal data here.</p>
        <?php endif; ?>

        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</body>
</html>
