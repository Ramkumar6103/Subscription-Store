<?php
session_start(); // Add this line!
require_once 'includes/db.php';
$sql = "SELECT * FROM products";
$products = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Product Store</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
      <a href="index.php">Home</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="user/dashboard.php">Dashboard</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="admin/dashboard.php">Admin</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </nav>
    <div class="container">
        <h1>Digital Product Store</h1>
        <hr>
        <h2>Available Products</h2>
        <div class="products">
            <?php while($row = $products->fetch_assoc()): ?>
                <div class="product-card">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <p>Price: $<?= $row['price'] ?> for <?= $row['duration_days'] ?> days</p>
                    <a href="user/subscribe.php?product_id=<?= $row['id'] ?>">Subscribe</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html> 