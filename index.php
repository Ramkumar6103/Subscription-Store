<?php
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
</head>
<body>
    <h1>Digital Product Store</h1>
    <a href="register.php">Register</a> | <a href="login.php">Login</a>
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
</body>
</html> 