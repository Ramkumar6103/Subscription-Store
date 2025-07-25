<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_admin();
$users = $conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'];
$products = $conn->query("SELECT COUNT(*) as c FROM products")->fetch_assoc()['c'];
$subs = $conn->query("SELECT COUNT(*) as c FROM subscriptions")->fetch_assoc()['c'];
$sales = $conn->query("SELECT IFNULL(SUM(amount),0) as s FROM payments WHERE status='success'")->fetch_assoc()['s'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="products.php">Products</a> |
        <a href="users.php">Users</a> |
        <a href="subscriptions.php">Subscriptions</a> |
        <a href="../logout.php">Logout</a>
    </nav>
    <div class="admin-panel">
        <h2>Admin Dashboard</h2>
        <ul>
            <li>Total Users: <?= $users ?></li>
            <li>Total Products: <?= $products ?></li>
            <li>Total Subscriptions: <?= $subs ?></li>
            <li>Total Sales: $<?= $sales ?></li>
        </ul>
    </div>
</body>
</html> 