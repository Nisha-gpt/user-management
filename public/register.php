<?php
require_once '../autoload.php';
use App\Database\Database;

session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $db = Database::getInstance()->getConnection();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) 
    {
        $message = "Email already exists.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $insert = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $insert->execute([$name, $email, $hashed, $role]);
        $message = "Registration successful. <a href='login.php'>Login here</a>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vilnius University Portal - Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }
        .container {
            background: #fff;
            padding: 30px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #900;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            background-color: #900;
            color: white;
            border: none;
            cursor: pointer;
        }
        .message {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vilnius University</h1>
        <h2>Student Registration Portal</h2>
        
        <?php if ($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Role:</label>
            <select name="role">
                <option value="Regular">Regular</option>
                <option value="Admin">Admin</option>
            </select>

            <button type="submit">Register</button>
        </form>
        <p style="text-align:center; margin-top:15px;">Already registered? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
