<?php
require_once '../autoload.php';
use App\Database\Database;

session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) 
    {
        $_SESSION['user'] = [
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];
        header("Location: dashboard.php");
        exit;
    } else 
    {
        $message = "❌ Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vilnius University - Login</title>
    <style>
        body 
        {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
        }
        .header 
        {
            background: #900;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
        .container 
        {
            background: white;
            padding: 30px;
            max-width: 500px;
            margin: 60px auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 
        {
            color: #900;
            text-align: center;
        }
        label 
        {
            margin-top: 10px;
            display: block;
        }
        input 
        {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
        }
        button 
        {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background: #900;
            color: white;
            border: none;
            font-size: 16px;
        }
        .error 
        {
            color: red;
            text-align: center;
        }
        .link 
        {
            text-align: center;
            margin-top: 10px;
        }
        a 
        {
            color: #900;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Vilnius University</h1>
    <h2>Login Portal</h2>
</div>

<div class="container">
    <?php if ($message): ?>
        <p class="error"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email Address:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div class="link">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

</body>
</html>
