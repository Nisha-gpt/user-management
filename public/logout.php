<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging out...</title>
    <meta http-equiv="refresh" content="2;url=login.php">
    <style>
        body 
        {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f8f8;
            text-align: center;
            padding: 100px;
            color: #444;
        }
        h1 
        {
            color: #900;
        }
    </style>
</head>
<body>
    <h1>Vilnius University</h1>
    <p>You are being securely logged out...</p>
    <p>Redirecting to login page.</p>
</body>
</html>
