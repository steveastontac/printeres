<?php
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>You are now in user dashboard page.</p>
        <p><a href="/printeres/html/consumer.html">Go to Shop</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>